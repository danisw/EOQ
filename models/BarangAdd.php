<?php

namespace PHPMaker2021\eoq;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class BarangAdd extends Barang
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'barang';

    // Page object name
    public $PageObjName = "BarangAdd";

    // Rendering View
    public $RenderingView = false;

    // Page headings
    public $Heading = "";
    public $Subheading = "";
    public $PageHeader;
    public $PageFooter;

    // Page terminated
    private $terminated = false;

    // Page heading
    public function pageHeading()
    {
        global $Language;
        if ($this->Heading != "") {
            return $this->Heading;
        }
        if (method_exists($this, "tableCaption")) {
            return $this->tableCaption();
        }
        return "";
    }

    // Page subheading
    public function pageSubheading()
    {
        global $Language;
        if ($this->Subheading != "") {
            return $this->Subheading;
        }
        if ($this->TableName) {
            return $Language->phrase($this->PageID);
        }
        return "";
    }

    // Page name
    public function pageName()
    {
        return CurrentPageName();
    }

    // Page URL
    public function pageUrl()
    {
        $url = ScriptName() . "?";
        if ($this->UseTokenInUrl) {
            $url .= "t=" . $this->TableVar . "&"; // Add page token
        }
        return $url;
    }

    // Show Page Header
    public function showPageHeader()
    {
        $header = $this->PageHeader;
        $this->pageDataRendering($header);
        if ($header != "") { // Header exists, display
            echo '<p id="ew-page-header">' . $header . '</p>';
        }
    }

    // Show Page Footer
    public function showPageFooter()
    {
        $footer = $this->PageFooter;
        $this->pageDataRendered($footer);
        if ($footer != "") { // Footer exists, display
            echo '<p id="ew-page-footer">' . $footer . '</p>';
        }
    }

    // Validate page request
    protected function isPageRequest()
    {
        global $CurrentForm;
        if ($this->UseTokenInUrl) {
            if ($CurrentForm) {
                return ($this->TableVar == $CurrentForm->getValue("t"));
            }
            if (Get("t") !== null) {
                return ($this->TableVar == Get("t"));
            }
        }
        return true;
    }

    // Constructor
    public function __construct()
    {
        global $Language, $DashboardReport, $DebugTimer;
        global $UserTable;

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Language object
        $Language = Container("language");

        // Parent constuctor
        parent::__construct();

        // Table object (barang)
        if (!isset($GLOBALS["barang"]) || get_class($GLOBALS["barang"]) == PROJECT_NAMESPACE . "barang") {
            $GLOBALS["barang"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'barang');
        }

        // Start timer
        $DebugTimer = Container("timer");

        // Debug message
        LoadDebugMessage();

        // Open connection
        $GLOBALS["Conn"] = $GLOBALS["Conn"] ?? $this->getConnection();

        // User table object
        $UserTable = Container("usertable");
    }

    // Get content from stream
    public function getContents($stream = null): string
    {
        global $Response;
        return is_object($Response) ? $Response->getBody() : ob_get_clean();
    }

    // Is lookup
    public function isLookup()
    {
        return SameText(Route(0), Config("API_LOOKUP_ACTION"));
    }

    // Is AutoFill
    public function isAutoFill()
    {
        return $this->isLookup() && SameText(Post("ajax"), "autofill");
    }

    // Is AutoSuggest
    public function isAutoSuggest()
    {
        return $this->isLookup() && SameText(Post("ajax"), "autosuggest");
    }

    // Is modal lookup
    public function isModalLookup()
    {
        return $this->isLookup() && SameText(Post("ajax"), "modal");
    }

    // Is terminated
    public function isTerminated()
    {
        return $this->terminated;
    }

    /**
     * Terminate page
     *
     * @param string $url URL for direction
     * @return void
     */
    public function terminate($url = "")
    {
        if ($this->terminated) {
            return;
        }
        global $ExportFileName, $TempImages, $DashboardReport, $Response;

        // Page is terminated
        $this->terminated = true;

         // Page Unload event
        if (method_exists($this, "pageUnload")) {
            $this->pageUnload();
        }

        // Global Page Unloaded event (in userfn*.php)
        Page_Unloaded();

        // Export
        if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
            $content = $this->getContents();
            if ($ExportFileName == "") {
                $ExportFileName = $this->TableVar;
            }
            $class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
            if (class_exists($class)) {
                $doc = new $class(Container("barang"));
                $doc->Text = @$content;
                if ($this->isExport("email")) {
                    echo $this->exportEmail($doc->Text);
                } else {
                    $doc->export();
                }
                DeleteTempImages(); // Delete temp images
                return;
            }
        }
        if (!IsApi() && method_exists($this, "pageRedirecting")) {
            $this->pageRedirecting($url);
        }

        // Close connection
        CloseConnections();

        // Return for API
        if (IsApi()) {
            $res = $url === true;
            if (!$res) { // Show error
                WriteJson(array_merge(["success" => false], $this->getMessages()));
            }
            return;
        } else { // Check if response is JSON
            if (StartsString("application/json", $Response->getHeaderLine("Content-type")) && $Response->getBody()->getSize()) { // With JSON response
                $this->clearMessages();
                return;
            }
        }

        // Go to URL if specified
        if ($url != "") {
            if (!Config("DEBUG") && ob_get_length()) {
                ob_end_clean();
            }

            // Handle modal response
            if ($this->IsModal) { // Show as modal
                $row = ["url" => GetUrl($url), "modal" => "1"];
                $pageName = GetPageName($url);
                if ($pageName != $this->getListUrl()) { // Not List page
                    $row["caption"] = $this->getModalCaption($pageName);
                    if ($pageName == "barangview") {
                        $row["view"] = "1";
                    }
                } else { // List page should not be shown as modal => error
                    $row["error"] = $this->getFailureMessage();
                    $this->clearFailureMessage();
                }
                WriteJson($row);
            } else {
                SaveDebugMessage();
                Redirect(GetUrl($url));
            }
        }
        return; // Return to controller
    }

    // Get records from recordset
    protected function getRecordsFromRecordset($rs, $current = false)
    {
        $rows = [];
        if (is_object($rs)) { // Recordset
            while ($rs && !$rs->EOF) {
                $this->loadRowValues($rs); // Set up DbValue/CurrentValue
                $row = $this->getRecordFromArray($rs->fields);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
                $rs->moveNext();
            }
        } elseif (is_array($rs)) {
            foreach ($rs as $ar) {
                $row = $this->getRecordFromArray($ar);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
            }
        }
        return $rows;
    }

    // Get record from array
    protected function getRecordFromArray($ar)
    {
        $row = [];
        if (is_array($ar)) {
            foreach ($ar as $fldname => $val) {
                if (array_key_exists($fldname, $this->Fields) && ($this->Fields[$fldname]->Visible || $this->Fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
                    $fld = &$this->Fields[$fldname];
                    if ($fld->HtmlTag == "FILE") { // Upload field
                        if (EmptyValue($val)) {
                            $row[$fldname] = null;
                        } else {
                            if ($fld->DataType == DATATYPE_BLOB) {
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . $fld->Param . "/" . rawurlencode($this->getRecordKeyValue($ar))));
                                $row[$fldname] = ["type" => ContentType($val), "url" => $url, "name" => $fld->Param . ContentExtension($val)];
                            } elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $val)));
                                $row[$fldname] = ["type" => MimeContentType($val), "url" => $url, "name" => $val];
                            } else { // Multiple files
                                $files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
                                $ar = [];
                                foreach ($files as $file) {
                                    $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                        "/" . $fld->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $file)));
                                    if (!EmptyValue($file)) {
                                        $ar[] = ["type" => MimeContentType($file), "url" => $url, "name" => $file];
                                    }
                                }
                                $row[$fldname] = $ar;
                            }
                        }
                    } else {
                        $row[$fldname] = $val;
                    }
                }
            }
        }
        return $row;
    }

    // Get record key value from array
    protected function getRecordKeyValue($ar)
    {
        $key = "";
        if (is_array($ar)) {
            $key .= @$ar['id_barang'];
        }
        return $key;
    }

    /**
     * Hide fields for add/edit
     *
     * @return void
     */
    protected function hideFieldsForAddEdit()
    {
        if ($this->isAdd() || $this->isCopy() || $this->isGridAdd()) {
            $this->id_barang->Visible = false;
        }
    }

    // Lookup data
    public function lookup()
    {
        global $Language, $Security;

        // Get lookup object
        $fieldName = Post("field");
        $lookup = $this->Fields[$fieldName]->Lookup;

        // Get lookup parameters
        $lookupType = Post("ajax", "unknown");
        $pageSize = -1;
        $offset = -1;
        $searchValue = "";
        if (SameText($lookupType, "modal")) {
            $searchValue = Post("sv", "");
            $pageSize = Post("recperpage", 10);
            $offset = Post("start", 0);
        } elseif (SameText($lookupType, "autosuggest")) {
            $searchValue = Param("q", "");
            $pageSize = Param("n", -1);
            $pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
            if ($pageSize <= 0) {
                $pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
            }
            $start = Param("start", -1);
            $start = is_numeric($start) ? (int)$start : -1;
            $page = Param("page", -1);
            $page = is_numeric($page) ? (int)$page : -1;
            $offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
        }
        $userSelect = Decrypt(Post("s", ""));
        $userFilter = Decrypt(Post("f", ""));
        $userOrderBy = Decrypt(Post("o", ""));
        $keys = Post("keys");
        $lookup->LookupType = $lookupType; // Lookup type
        if ($keys !== null) { // Selected records from modal
            if (is_array($keys)) {
                $keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
            }
            $lookup->FilterFields = []; // Skip parent fields if any
            $lookup->FilterValues[] = $keys; // Lookup values
            $pageSize = -1; // Show all records
        } else { // Lookup values
            $lookup->FilterValues[] = Post("v0", Post("lookupValue", ""));
        }
        $cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
        for ($i = 1; $i <= $cnt; $i++) {
            $lookup->FilterValues[] = Post("v" . $i, "");
        }
        $lookup->SearchValue = $searchValue;
        $lookup->PageSize = $pageSize;
        $lookup->Offset = $offset;
        if ($userSelect != "") {
            $lookup->UserSelect = $userSelect;
        }
        if ($userFilter != "") {
            $lookup->UserFilter = $userFilter;
        }
        if ($userOrderBy != "") {
            $lookup->UserOrderBy = $userOrderBy;
        }
        $lookup->toJson($this); // Use settings from current page
    }
    public $FormClassName = "ew-horizontal ew-form ew-add-form";
    public $IsModal = false;
    public $IsMobileOrModal = false;
    public $DbMasterFilter = "";
    public $DbDetailFilter = "";
    public $StartRecord;
    public $Priv = 0;
    public $OldRecordset;
    public $CopyRecord;

    /**
     * Page run
     *
     * @return void
     */
    public function run()
    {
        global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
            $SkipHeaderFooter;

        // Is modal
        $this->IsModal = Param("modal") == "1";

        // Create form object
        $CurrentForm = new HttpForm();
        $this->CurrentAction = Param("action"); // Set up current action
        $this->id_barang->Visible = false;
        $this->nama_barang->setVisibility();
        $this->harga_barang->setVisibility();
        $this->biaya_penyimpanan->setVisibility();
        $this->periode_permintaan->setVisibility();
        $this->satuan->setVisibility();
        $this->konversi->setVisibility();
        $this->hideFieldsForAddEdit();

        // Do not use lookup cache
        $this->setUseLookupCache(false);

        // Global Page Loading event (in userfn*.php)
        Page_Loading();

        // Page Load event
        if (method_exists($this, "pageLoad")) {
            $this->pageLoad();
        }

        // Set up lookup cache

        // Check modal
        if ($this->IsModal) {
            $SkipHeaderFooter = true;
        }
        $this->IsMobileOrModal = IsMobile() || $this->IsModal;
        $this->FormClassName = "ew-form ew-add-form ew-horizontal";
        $postBack = false;

        // Set up current action
        if (IsApi()) {
            $this->CurrentAction = "insert"; // Add record directly
            $postBack = true;
        } elseif (Post("action") !== null) {
            $this->CurrentAction = Post("action"); // Get form action
            $this->setKey(Post($this->OldKeyName));
            $postBack = true;
        } else {
            // Load key values from QueryString
            if (($keyValue = Get("id_barang") ?? Route("id_barang")) !== null) {
                $this->id_barang->setQueryStringValue($keyValue);
            }
            $this->OldKey = $this->getKey(true); // Get from CurrentValue
            $this->CopyRecord = !EmptyValue($this->OldKey);
            if ($this->CopyRecord) {
                $this->CurrentAction = "copy"; // Copy record
            } else {
                $this->CurrentAction = "show"; // Display blank record
            }
        }

        // Load old record / default values
        $loaded = $this->loadOldRecord();

        // Load form values
        if ($postBack) {
            $this->loadFormValues(); // Load form values
        }

        // Validate form if post back
        if ($postBack) {
            if (!$this->validateForm()) {
                $this->EventCancelled = true; // Event cancelled
                $this->restoreFormValues(); // Restore form values
                if (IsApi()) {
                    $this->terminate();
                    return;
                } else {
                    $this->CurrentAction = "show"; // Form error, reset action
                }
            }
        }

        // Perform current action
        switch ($this->CurrentAction) {
            case "copy": // Copy an existing record
                if (!$loaded) { // Record not loaded
                    if ($this->getFailureMessage() == "") {
                        $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
                    }
                    $this->terminate("baranglist"); // No matching record, return to list
                    return;
                }
                break;
            case "insert": // Add new record
                $this->SendEmail = true; // Send email on add success
                if ($this->addRow($this->OldRecordset)) { // Add successful
                    if ($this->getSuccessMessage() == "" && Post("addopt") != "1") { // Skip success message for addopt (done in JavaScript)
                        $this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
                    }
                    $returnUrl = $this->getReturnUrl();
                    if (GetPageName($returnUrl) == "baranglist") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "barangview") {
                        $returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
                    }
                    if (IsApi()) { // Return to caller
                        $this->terminate(true);
                        return;
                    } else {
                        $this->terminate($returnUrl);
                        return;
                    }
                } elseif (IsApi()) { // API request, return
                    $this->terminate();
                    return;
                } else {
                    $this->EventCancelled = true; // Event cancelled
                    $this->restoreFormValues(); // Add failed, restore form values
                }
        }

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Render row based on row type
        $this->RowType = ROWTYPE_ADD; // Render add type

        // Render row
        $this->resetAttributes();
        $this->renderRow();

        // Set LoginStatus / Page_Rendering / Page_Render
        if (!IsApi() && !$this->isTerminated()) {
            // Pass table and field properties to client side
            $this->toClientVar(["tableCaption"], ["caption", "Visible", "Required", "IsInvalid", "Raw"]);

            // Setup login status
            SetupLoginStatus();

            // Pass login status to client side
            SetClientVar("login", LoginStatus());

            // Global Page Rendering event (in userfn*.php)
            Page_Rendering();

            // Page Render event
            if (method_exists($this, "pageRender")) {
                $this->pageRender();
            }
        }
    }

    // Get upload files
    protected function getUploadFiles()
    {
        global $CurrentForm, $Language;
    }

    // Load default values
    protected function loadDefaultValues()
    {
        $this->id_barang->CurrentValue = null;
        $this->id_barang->OldValue = $this->id_barang->CurrentValue;
        $this->nama_barang->CurrentValue = null;
        $this->nama_barang->OldValue = $this->nama_barang->CurrentValue;
        $this->harga_barang->CurrentValue = null;
        $this->harga_barang->OldValue = $this->harga_barang->CurrentValue;
        $this->biaya_penyimpanan->CurrentValue = null;
        $this->biaya_penyimpanan->OldValue = $this->biaya_penyimpanan->CurrentValue;
        $this->periode_permintaan->CurrentValue = null;
        $this->periode_permintaan->OldValue = $this->periode_permintaan->CurrentValue;
        $this->satuan->CurrentValue = null;
        $this->satuan->OldValue = $this->satuan->CurrentValue;
        $this->konversi->CurrentValue = null;
        $this->konversi->OldValue = $this->konversi->CurrentValue;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;

        // Check field name 'nama_barang' first before field var 'x_nama_barang'
        $val = $CurrentForm->hasValue("nama_barang") ? $CurrentForm->getValue("nama_barang") : $CurrentForm->getValue("x_nama_barang");
        if (!$this->nama_barang->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->nama_barang->Visible = false; // Disable update for API request
            } else {
                $this->nama_barang->setFormValue($val);
            }
        }

        // Check field name 'harga_barang' first before field var 'x_harga_barang'
        $val = $CurrentForm->hasValue("harga_barang") ? $CurrentForm->getValue("harga_barang") : $CurrentForm->getValue("x_harga_barang");
        if (!$this->harga_barang->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->harga_barang->Visible = false; // Disable update for API request
            } else {
                $this->harga_barang->setFormValue($val);
            }
        }

        // Check field name 'biaya_penyimpanan' first before field var 'x_biaya_penyimpanan'
        $val = $CurrentForm->hasValue("biaya_penyimpanan") ? $CurrentForm->getValue("biaya_penyimpanan") : $CurrentForm->getValue("x_biaya_penyimpanan");
        if (!$this->biaya_penyimpanan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->biaya_penyimpanan->Visible = false; // Disable update for API request
            } else {
                $this->biaya_penyimpanan->setFormValue($val);
            }
        }

        // Check field name 'periode_permintaan' first before field var 'x_periode_permintaan'
        $val = $CurrentForm->hasValue("periode_permintaan") ? $CurrentForm->getValue("periode_permintaan") : $CurrentForm->getValue("x_periode_permintaan");
        if (!$this->periode_permintaan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->periode_permintaan->Visible = false; // Disable update for API request
            } else {
                $this->periode_permintaan->setFormValue($val);
            }
        }

        // Check field name 'satuan' first before field var 'x_satuan'
        $val = $CurrentForm->hasValue("satuan") ? $CurrentForm->getValue("satuan") : $CurrentForm->getValue("x_satuan");
        if (!$this->satuan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->satuan->Visible = false; // Disable update for API request
            } else {
                $this->satuan->setFormValue($val);
            }
        }

        // Check field name 'konversi' first before field var 'x_konversi'
        $val = $CurrentForm->hasValue("konversi") ? $CurrentForm->getValue("konversi") : $CurrentForm->getValue("x_konversi");
        if (!$this->konversi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->konversi->Visible = false; // Disable update for API request
            } else {
                $this->konversi->setFormValue($val);
            }
        }

        // Check field name 'id_barang' first before field var 'x_id_barang'
        $val = $CurrentForm->hasValue("id_barang") ? $CurrentForm->getValue("id_barang") : $CurrentForm->getValue("x_id_barang");
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->nama_barang->CurrentValue = $this->nama_barang->FormValue;
        $this->harga_barang->CurrentValue = $this->harga_barang->FormValue;
        $this->biaya_penyimpanan->CurrentValue = $this->biaya_penyimpanan->FormValue;
        $this->periode_permintaan->CurrentValue = $this->periode_permintaan->FormValue;
        $this->satuan->CurrentValue = $this->satuan->FormValue;
        $this->konversi->CurrentValue = $this->konversi->FormValue;
    }

    /**
     * Load row based on key values
     *
     * @return void
     */
    public function loadRow()
    {
        global $Security, $Language;
        $filter = $this->getRecordFilter();

        // Call Row Selecting event
        $this->rowSelecting($filter);

        // Load SQL based on filter
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        $res = false;
        $row = $conn->fetchAssoc($sql);
        if ($row) {
            $res = true;
            $this->loadRowValues($row); // Load row values
        }
        return $res;
    }

    /**
     * Load row values from recordset or record
     *
     * @param Recordset|array $rs Record
     * @return void
     */
    public function loadRowValues($rs = null)
    {
        if (is_array($rs)) {
            $row = $rs;
        } elseif ($rs && property_exists($rs, "fields")) { // Recordset
            $row = $rs->fields;
        } else {
            $row = $this->newRow();
        }

        // Call Row Selected event
        $this->rowSelected($row);
        if (!$rs) {
            return;
        }
        $this->id_barang->setDbValue($row['id_barang']);
        $this->nama_barang->setDbValue($row['nama_barang']);
        $this->harga_barang->setDbValue($row['harga_barang']);
        $this->biaya_penyimpanan->setDbValue($row['biaya_penyimpanan']);
        $this->periode_permintaan->setDbValue($row['periode_permintaan']);
        $this->satuan->setDbValue($row['satuan']);
        $this->konversi->setDbValue($row['konversi']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $this->loadDefaultValues();
        $row = [];
        $row['id_barang'] = $this->id_barang->CurrentValue;
        $row['nama_barang'] = $this->nama_barang->CurrentValue;
        $row['harga_barang'] = $this->harga_barang->CurrentValue;
        $row['biaya_penyimpanan'] = $this->biaya_penyimpanan->CurrentValue;
        $row['periode_permintaan'] = $this->periode_permintaan->CurrentValue;
        $row['satuan'] = $this->satuan->CurrentValue;
        $row['konversi'] = $this->konversi->CurrentValue;
        return $row;
    }

    // Load old record
    protected function loadOldRecord()
    {
        // Load old record
        $this->OldRecordset = null;
        $validKey = $this->OldKey != "";
        if ($validKey) {
            $this->CurrentFilter = $this->getRecordFilter();
            $sql = $this->getCurrentSql();
            $conn = $this->getConnection();
            $this->OldRecordset = LoadRecordset($sql, $conn);
        }
        $this->loadRowValues($this->OldRecordset); // Load row values
        return $validKey;
    }

    // Render row values based on field settings
    public function renderRow()
    {
        global $Security, $Language, $CurrentLanguage;

        // Initialize URLs

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // id_barang

        // nama_barang

        // harga_barang

        // biaya_penyimpanan

        // periode_permintaan

        // satuan

        // konversi
        if ($this->RowType == ROWTYPE_VIEW) {
            // id_barang
            $this->id_barang->ViewValue = $this->id_barang->CurrentValue;
            $this->id_barang->ViewCustomAttributes = "";

            // nama_barang
            $this->nama_barang->ViewValue = $this->nama_barang->CurrentValue;
            $this->nama_barang->ViewCustomAttributes = "";

            // harga_barang
            $this->harga_barang->ViewValue = $this->harga_barang->CurrentValue;
            $this->harga_barang->ViewCustomAttributes = "";

            // biaya_penyimpanan
            $this->biaya_penyimpanan->ViewValue = $this->biaya_penyimpanan->CurrentValue;
            $this->biaya_penyimpanan->ViewCustomAttributes = "";

            // periode_permintaan
            $this->periode_permintaan->ViewValue = $this->periode_permintaan->CurrentValue;
            $this->periode_permintaan->ViewCustomAttributes = "";

            // satuan
            $this->satuan->ViewValue = $this->satuan->CurrentValue;
            $this->satuan->ViewCustomAttributes = "";

            // konversi
            $this->konversi->ViewValue = $this->konversi->CurrentValue;
            $this->konversi->ViewCustomAttributes = "";

            // nama_barang
            $this->nama_barang->LinkCustomAttributes = "";
            $this->nama_barang->HrefValue = "";
            $this->nama_barang->TooltipValue = "";

            // harga_barang
            $this->harga_barang->LinkCustomAttributes = "";
            $this->harga_barang->HrefValue = "";
            $this->harga_barang->TooltipValue = "";

            // biaya_penyimpanan
            $this->biaya_penyimpanan->LinkCustomAttributes = "";
            $this->biaya_penyimpanan->HrefValue = "";
            $this->biaya_penyimpanan->TooltipValue = "";

            // periode_permintaan
            $this->periode_permintaan->LinkCustomAttributes = "";
            $this->periode_permintaan->HrefValue = "";
            $this->periode_permintaan->TooltipValue = "";

            // satuan
            $this->satuan->LinkCustomAttributes = "";
            $this->satuan->HrefValue = "";
            $this->satuan->TooltipValue = "";

            // konversi
            $this->konversi->LinkCustomAttributes = "";
            $this->konversi->HrefValue = "";
            $this->konversi->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // nama_barang
            $this->nama_barang->EditAttrs["class"] = "form-control";
            $this->nama_barang->EditCustomAttributes = "";
            if (!$this->nama_barang->Raw) {
                $this->nama_barang->CurrentValue = HtmlDecode($this->nama_barang->CurrentValue);
            }
            $this->nama_barang->EditValue = HtmlEncode($this->nama_barang->CurrentValue);
            $this->nama_barang->PlaceHolder = RemoveHtml($this->nama_barang->caption());

            // harga_barang
            $this->harga_barang->EditAttrs["class"] = "form-control";
            $this->harga_barang->EditCustomAttributes = "";
            if (!$this->harga_barang->Raw) {
                $this->harga_barang->CurrentValue = HtmlDecode($this->harga_barang->CurrentValue);
            }
            $this->harga_barang->EditValue = HtmlEncode($this->harga_barang->CurrentValue);
            $this->harga_barang->PlaceHolder = RemoveHtml($this->harga_barang->caption());

            // biaya_penyimpanan
            $this->biaya_penyimpanan->EditAttrs["class"] = "form-control";
            $this->biaya_penyimpanan->EditCustomAttributes = "";
            if (!$this->biaya_penyimpanan->Raw) {
                $this->biaya_penyimpanan->CurrentValue = HtmlDecode($this->biaya_penyimpanan->CurrentValue);
            }
            $this->biaya_penyimpanan->EditValue = HtmlEncode($this->biaya_penyimpanan->CurrentValue);
            $this->biaya_penyimpanan->PlaceHolder = RemoveHtml($this->biaya_penyimpanan->caption());

            // periode_permintaan
            $this->periode_permintaan->EditAttrs["class"] = "form-control";
            $this->periode_permintaan->EditCustomAttributes = "";
            if (!$this->periode_permintaan->Raw) {
                $this->periode_permintaan->CurrentValue = HtmlDecode($this->periode_permintaan->CurrentValue);
            }
            $this->periode_permintaan->EditValue = HtmlEncode($this->periode_permintaan->CurrentValue);
            $this->periode_permintaan->PlaceHolder = RemoveHtml($this->periode_permintaan->caption());

            // satuan
            $this->satuan->EditAttrs["class"] = "form-control";
            $this->satuan->EditCustomAttributes = "";
            if (!$this->satuan->Raw) {
                $this->satuan->CurrentValue = HtmlDecode($this->satuan->CurrentValue);
            }
            $this->satuan->EditValue = HtmlEncode($this->satuan->CurrentValue);
            $this->satuan->PlaceHolder = RemoveHtml($this->satuan->caption());

            // konversi
            $this->konversi->EditAttrs["class"] = "form-control";
            $this->konversi->EditCustomAttributes = "";
            if (!$this->konversi->Raw) {
                $this->konversi->CurrentValue = HtmlDecode($this->konversi->CurrentValue);
            }
            $this->konversi->EditValue = HtmlEncode($this->konversi->CurrentValue);
            $this->konversi->PlaceHolder = RemoveHtml($this->konversi->caption());

            // Add refer script

            // nama_barang
            $this->nama_barang->LinkCustomAttributes = "";
            $this->nama_barang->HrefValue = "";

            // harga_barang
            $this->harga_barang->LinkCustomAttributes = "";
            $this->harga_barang->HrefValue = "";

            // biaya_penyimpanan
            $this->biaya_penyimpanan->LinkCustomAttributes = "";
            $this->biaya_penyimpanan->HrefValue = "";

            // periode_permintaan
            $this->periode_permintaan->LinkCustomAttributes = "";
            $this->periode_permintaan->HrefValue = "";

            // satuan
            $this->satuan->LinkCustomAttributes = "";
            $this->satuan->HrefValue = "";

            // konversi
            $this->konversi->LinkCustomAttributes = "";
            $this->konversi->HrefValue = "";
        }
        if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) { // Add/Edit/Search row
            $this->setupFieldTitles();
        }

        // Call Row Rendered event
        if ($this->RowType != ROWTYPE_AGGREGATEINIT) {
            $this->rowRendered();
        }
    }

    // Validate form
    protected function validateForm()
    {
        global $Language;

        // Check if validation required
        if (!Config("SERVER_VALIDATE")) {
            return true;
        }
        if ($this->nama_barang->Required) {
            if (!$this->nama_barang->IsDetailKey && EmptyValue($this->nama_barang->FormValue)) {
                $this->nama_barang->addErrorMessage(str_replace("%s", $this->nama_barang->caption(), $this->nama_barang->RequiredErrorMessage));
            }
        }
        if ($this->harga_barang->Required) {
            if (!$this->harga_barang->IsDetailKey && EmptyValue($this->harga_barang->FormValue)) {
                $this->harga_barang->addErrorMessage(str_replace("%s", $this->harga_barang->caption(), $this->harga_barang->RequiredErrorMessage));
            }
        }
        if ($this->biaya_penyimpanan->Required) {
            if (!$this->biaya_penyimpanan->IsDetailKey && EmptyValue($this->biaya_penyimpanan->FormValue)) {
                $this->biaya_penyimpanan->addErrorMessage(str_replace("%s", $this->biaya_penyimpanan->caption(), $this->biaya_penyimpanan->RequiredErrorMessage));
            }
        }
        if ($this->periode_permintaan->Required) {
            if (!$this->periode_permintaan->IsDetailKey && EmptyValue($this->periode_permintaan->FormValue)) {
                $this->periode_permintaan->addErrorMessage(str_replace("%s", $this->periode_permintaan->caption(), $this->periode_permintaan->RequiredErrorMessage));
            }
        }
        if ($this->satuan->Required) {
            if (!$this->satuan->IsDetailKey && EmptyValue($this->satuan->FormValue)) {
                $this->satuan->addErrorMessage(str_replace("%s", $this->satuan->caption(), $this->satuan->RequiredErrorMessage));
            }
        }
        if ($this->konversi->Required) {
            if (!$this->konversi->IsDetailKey && EmptyValue($this->konversi->FormValue)) {
                $this->konversi->addErrorMessage(str_replace("%s", $this->konversi->caption(), $this->konversi->RequiredErrorMessage));
            }
        }

        // Return validate result
        $validateForm = !$this->hasInvalidFields();

        // Call Form_CustomValidate event
        $formCustomError = "";
        $validateForm = $validateForm && $this->formCustomValidate($formCustomError);
        if ($formCustomError != "") {
            $this->setFailureMessage($formCustomError);
        }
        return $validateForm;
    }

    // Add record
    protected function addRow($rsold = null)
    {
        global $Language, $Security;
        if ($this->nama_barang->CurrentValue != "") { // Check field with unique index
            $filter = "(`nama_barang` = '" . AdjustSql($this->nama_barang->CurrentValue, $this->Dbid) . "')";
            $rsChk = $this->loadRs($filter)->fetch();
            if ($rsChk !== false) {
                $idxErrMsg = str_replace("%f", $this->nama_barang->caption(), $Language->phrase("DupIndex"));
                $idxErrMsg = str_replace("%v", $this->nama_barang->CurrentValue, $idxErrMsg);
                $this->setFailureMessage($idxErrMsg);
                return false;
            }
        }
        $conn = $this->getConnection();

        // Load db values from rsold
        $this->loadDbValues($rsold);
        if ($rsold) {
        }
        $rsnew = [];

        // nama_barang
        $this->nama_barang->setDbValueDef($rsnew, $this->nama_barang->CurrentValue, "", false);

        // harga_barang
        $this->harga_barang->setDbValueDef($rsnew, $this->harga_barang->CurrentValue, "", false);

        // biaya_penyimpanan
        $this->biaya_penyimpanan->setDbValueDef($rsnew, $this->biaya_penyimpanan->CurrentValue, "", false);

        // periode_permintaan
        $this->periode_permintaan->setDbValueDef($rsnew, $this->periode_permintaan->CurrentValue, "", false);

        // satuan
        $this->satuan->setDbValueDef($rsnew, $this->satuan->CurrentValue, "", false);

        // konversi
        $this->konversi->setDbValueDef($rsnew, $this->konversi->CurrentValue, "", false);

        // Call Row Inserting event
        $insertRow = $this->rowInserting($rsold, $rsnew);
        $addRow = false;
        if ($insertRow) {
            try {
                $addRow = $this->insert($rsnew);
            } catch (\Exception $e) {
                $this->setFailureMessage($e->getMessage());
            }
            if ($addRow) {
            }
        } else {
            if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                // Use the message, do nothing
            } elseif ($this->CancelMessage != "") {
                $this->setFailureMessage($this->CancelMessage);
                $this->CancelMessage = "";
            } else {
                $this->setFailureMessage($Language->phrase("InsertCancelled"));
            }
            $addRow = false;
        }
        if ($addRow) {
            // Call Row Inserted event
            $this->rowInserted($rsold, $rsnew);
        }

        // Clean upload path if any
        if ($addRow) {
        }

        // Write JSON for API request
        if (IsApi() && $addRow) {
            $row = $this->getRecordsFromRecordset([$rsnew], true);
            WriteJson(["success" => true, $this->TableVar => $row]);
        }
        return $addRow;
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("eoq_3/stocklist");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("baranglist"), "", $this->TableVar, true);
        $pageId = ($this->isCopy()) ? "Copy" : "Add";
        $Breadcrumb->add("add", $pageId, $url);
    }

    // Setup lookup options
    public function setupLookupOptions($fld)
    {
        if ($fld->Lookup !== null && $fld->Lookup->Options === null) {
            // Get default connection and filter
            $conn = $this->getConnection();
            $lookupFilter = "";

            // No need to check any more
            $fld->Lookup->Options = [];

            // Set up lookup SQL and connection
            switch ($fld->FieldVar) {
                default:
                    $lookupFilter = "";
                    break;
            }

            // Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
            $sql = $fld->Lookup->getSql(false, "", $lookupFilter, $this);

            // Set up lookup cache
            if ($fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0) {
                $totalCnt = $this->getRecordCount($sql, $conn);
                if ($totalCnt > $fld->LookupCacheCount) { // Total count > cache count, do not cache
                    return;
                }
                $rows = $conn->executeQuery($sql)->fetchAll(\PDO::FETCH_BOTH);
                $ar = [];
                foreach ($rows as $row) {
                    $row = $fld->Lookup->renderViewRow($row);
                    $ar[strval($row[0])] = $row;
                }
                $fld->Lookup->Options = $ar;
            }
        }
    }

    // Page Load event
    public function pageLoad()
    {
        //Log("Page Load");
    }

    // Page Unload event
    public function pageUnload()
    {
        //Log("Page Unload");
    }

    // Page Redirecting event
    public function pageRedirecting(&$url)
    {
        // Example:
        //$url = "your URL";
    }

    // Message Showing event
    // $type = ''|'success'|'failure'|'warning'
    public function messageShowing(&$msg, $type)
    {
        if ($type == 'success') {
            //$msg = "your success message";
        } elseif ($type == 'failure') {
            //$msg = "your failure message";
        } elseif ($type == 'warning') {
            //$msg = "your warning message";
        } else {
            //$msg = "your message";
        }
    }

    // Page Render event
    public function pageRender()
    {
        //Log("Page Render");
    }

    // Page Data Rendering event
    public function pageDataRendering(&$header)
    {
        // Example:
        //$header = "your header";
    }

    // Page Data Rendered event
    public function pageDataRendered(&$footer)
    {
        // Example:
        //$footer = "your footer";
    }

    // Form Custom Validate event
    public function formCustomValidate(&$customError)
    {
        // Return error message in CustomError
        return true;
    }
}
