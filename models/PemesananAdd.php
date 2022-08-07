<?php

namespace PHPMaker2021\eoq;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class PemesananAdd extends Pemesanan
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'pemesanan';

    // Page object name
    public $PageObjName = "PemesananAdd";

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

        // Table object (pemesanan)
        if (!isset($GLOBALS["pemesanan"]) || get_class($GLOBALS["pemesanan"]) == PROJECT_NAMESPACE . "pemesanan") {
            $GLOBALS["pemesanan"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'pemesanan');
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
                $doc = new $class(Container("pemesanan"));
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
                    if ($pageName == "pemesananview") {
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
            $key .= @$ar['id_pesanan'];
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
            $this->id_pesanan->Visible = false;
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
        $this->id_pesanan->Visible = false;
        $this->nama_pemesan->setVisibility();
        $this->id_barang->setVisibility();
        $this->jumlah_pesanan->setVisibility();
        $this->lead_time->setVisibility();
        $this->pakai->setVisibility();
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
            if (($keyValue = Get("id_pesanan") ?? Route("id_pesanan")) !== null) {
                $this->id_pesanan->setQueryStringValue($keyValue);
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
                    $this->terminate("pemesananlist"); // No matching record, return to list
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
                    if (GetPageName($returnUrl) == "pemesananlist") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "pemesananview") {
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
        $this->id_pesanan->CurrentValue = null;
        $this->id_pesanan->OldValue = $this->id_pesanan->CurrentValue;
        $this->nama_pemesan->CurrentValue = null;
        $this->nama_pemesan->OldValue = $this->nama_pemesan->CurrentValue;
        $this->id_barang->CurrentValue = null;
        $this->id_barang->OldValue = $this->id_barang->CurrentValue;
        $this->jumlah_pesanan->CurrentValue = null;
        $this->jumlah_pesanan->OldValue = $this->jumlah_pesanan->CurrentValue;
        $this->lead_time->CurrentValue = null;
        $this->lead_time->OldValue = $this->lead_time->CurrentValue;
        $this->pakai->CurrentValue = null;
        $this->pakai->OldValue = $this->pakai->CurrentValue;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;

        // Check field name 'nama_pemesan' first before field var 'x_nama_pemesan'
        $val = $CurrentForm->hasValue("nama_pemesan") ? $CurrentForm->getValue("nama_pemesan") : $CurrentForm->getValue("x_nama_pemesan");
        if (!$this->nama_pemesan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->nama_pemesan->Visible = false; // Disable update for API request
            } else {
                $this->nama_pemesan->setFormValue($val);
            }
        }

        // Check field name 'id_barang' first before field var 'x_id_barang'
        $val = $CurrentForm->hasValue("id_barang") ? $CurrentForm->getValue("id_barang") : $CurrentForm->getValue("x_id_barang");
        if (!$this->id_barang->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->id_barang->Visible = false; // Disable update for API request
            } else {
                $this->id_barang->setFormValue($val);
            }
        }

        // Check field name 'jumlah_pesanan' first before field var 'x_jumlah_pesanan'
        $val = $CurrentForm->hasValue("jumlah_pesanan") ? $CurrentForm->getValue("jumlah_pesanan") : $CurrentForm->getValue("x_jumlah_pesanan");
        if (!$this->jumlah_pesanan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->jumlah_pesanan->Visible = false; // Disable update for API request
            } else {
                $this->jumlah_pesanan->setFormValue($val);
            }
        }

        // Check field name 'lead_time' first before field var 'x_lead_time'
        $val = $CurrentForm->hasValue("lead_time") ? $CurrentForm->getValue("lead_time") : $CurrentForm->getValue("x_lead_time");
        if (!$this->lead_time->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->lead_time->Visible = false; // Disable update for API request
            } else {
                $this->lead_time->setFormValue($val);
            }
        }

        // Check field name 'pakai' first before field var 'x_pakai'
        $val = $CurrentForm->hasValue("pakai") ? $CurrentForm->getValue("pakai") : $CurrentForm->getValue("x_pakai");
        if (!$this->pakai->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->pakai->Visible = false; // Disable update for API request
            } else {
                $this->pakai->setFormValue($val);
            }
        }

        // Check field name 'id_pesanan' first before field var 'x_id_pesanan'
        $val = $CurrentForm->hasValue("id_pesanan") ? $CurrentForm->getValue("id_pesanan") : $CurrentForm->getValue("x_id_pesanan");
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->nama_pemesan->CurrentValue = $this->nama_pemesan->FormValue;
        $this->id_barang->CurrentValue = $this->id_barang->FormValue;
        $this->jumlah_pesanan->CurrentValue = $this->jumlah_pesanan->FormValue;
        $this->lead_time->CurrentValue = $this->lead_time->FormValue;
        $this->pakai->CurrentValue = $this->pakai->FormValue;
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
        $this->id_pesanan->setDbValue($row['id_pesanan']);
        $this->nama_pemesan->setDbValue($row['nama_pemesan']);
        $this->id_barang->setDbValue($row['id_barang']);
        $this->jumlah_pesanan->setDbValue($row['jumlah_pesanan']);
        $this->lead_time->setDbValue($row['lead_time']);
        $this->pakai->setDbValue($row['pakai']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $this->loadDefaultValues();
        $row = [];
        $row['id_pesanan'] = $this->id_pesanan->CurrentValue;
        $row['nama_pemesan'] = $this->nama_pemesan->CurrentValue;
        $row['id_barang'] = $this->id_barang->CurrentValue;
        $row['jumlah_pesanan'] = $this->jumlah_pesanan->CurrentValue;
        $row['lead_time'] = $this->lead_time->CurrentValue;
        $row['pakai'] = $this->pakai->CurrentValue;
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

        // id_pesanan

        // nama_pemesan

        // id_barang

        // jumlah_pesanan

        // lead_time

        // pakai
        if ($this->RowType == ROWTYPE_VIEW) {
            // id_pesanan
            $this->id_pesanan->ViewValue = $this->id_pesanan->CurrentValue;
            $this->id_pesanan->ViewCustomAttributes = "";

            // nama_pemesan
            $this->nama_pemesan->ViewValue = $this->nama_pemesan->CurrentValue;
            $this->nama_pemesan->ViewCustomAttributes = "";

            // id_barang
            $this->id_barang->ViewValue = $this->id_barang->CurrentValue;
            $this->id_barang->ViewValue = FormatNumber($this->id_barang->ViewValue, 0, -2, -2, -2);
            $this->id_barang->ViewCustomAttributes = "";

            // jumlah_pesanan
            $this->jumlah_pesanan->ViewValue = $this->jumlah_pesanan->CurrentValue;
            $this->jumlah_pesanan->ViewCustomAttributes = "";

            // lead_time
            $this->lead_time->ViewValue = $this->lead_time->CurrentValue;
            $this->lead_time->ViewValue = FormatNumber($this->lead_time->ViewValue, 0, -2, -2, -2);
            $this->lead_time->ViewCustomAttributes = "";

            // pakai
            $this->pakai->ViewValue = $this->pakai->CurrentValue;
            $this->pakai->ViewCustomAttributes = "";

            // nama_pemesan
            $this->nama_pemesan->LinkCustomAttributes = "";
            $this->nama_pemesan->HrefValue = "";
            $this->nama_pemesan->TooltipValue = "";

            // id_barang
            $this->id_barang->LinkCustomAttributes = "";
            $this->id_barang->HrefValue = "";
            $this->id_barang->TooltipValue = "";

            // jumlah_pesanan
            $this->jumlah_pesanan->LinkCustomAttributes = "";
            $this->jumlah_pesanan->HrefValue = "";
            $this->jumlah_pesanan->TooltipValue = "";

            // lead_time
            $this->lead_time->LinkCustomAttributes = "";
            $this->lead_time->HrefValue = "";
            $this->lead_time->TooltipValue = "";

            // pakai
            $this->pakai->LinkCustomAttributes = "";
            $this->pakai->HrefValue = "";
            $this->pakai->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // nama_pemesan
            $this->nama_pemesan->EditAttrs["class"] = "form-control";
            $this->nama_pemesan->EditCustomAttributes = "";
            if (!$this->nama_pemesan->Raw) {
                $this->nama_pemesan->CurrentValue = HtmlDecode($this->nama_pemesan->CurrentValue);
            }
            $this->nama_pemesan->EditValue = HtmlEncode($this->nama_pemesan->CurrentValue);
            $this->nama_pemesan->PlaceHolder = RemoveHtml($this->nama_pemesan->caption());

            // id_barang
            $this->id_barang->EditAttrs["class"] = "form-control";
            $this->id_barang->EditCustomAttributes = "";
            $this->id_barang->EditValue = HtmlEncode($this->id_barang->CurrentValue);
            $this->id_barang->PlaceHolder = RemoveHtml($this->id_barang->caption());

            // jumlah_pesanan
            $this->jumlah_pesanan->EditAttrs["class"] = "form-control";
            $this->jumlah_pesanan->EditCustomAttributes = "";
            if (!$this->jumlah_pesanan->Raw) {
                $this->jumlah_pesanan->CurrentValue = HtmlDecode($this->jumlah_pesanan->CurrentValue);
            }
            $this->jumlah_pesanan->EditValue = HtmlEncode($this->jumlah_pesanan->CurrentValue);
            $this->jumlah_pesanan->PlaceHolder = RemoveHtml($this->jumlah_pesanan->caption());

            // lead_time
            $this->lead_time->EditAttrs["class"] = "form-control";
            $this->lead_time->EditCustomAttributes = "";
            $this->lead_time->EditValue = HtmlEncode($this->lead_time->CurrentValue);
            $this->lead_time->PlaceHolder = RemoveHtml($this->lead_time->caption());

            // pakai
            $this->pakai->EditAttrs["class"] = "form-control";
            $this->pakai->EditCustomAttributes = "";
            if (!$this->pakai->Raw) {
                $this->pakai->CurrentValue = HtmlDecode($this->pakai->CurrentValue);
            }
            $this->pakai->EditValue = HtmlEncode($this->pakai->CurrentValue);
            $this->pakai->PlaceHolder = RemoveHtml($this->pakai->caption());

            // Add refer script

            // nama_pemesan
            $this->nama_pemesan->LinkCustomAttributes = "";
            $this->nama_pemesan->HrefValue = "";

            // id_barang
            $this->id_barang->LinkCustomAttributes = "";
            $this->id_barang->HrefValue = "";

            // jumlah_pesanan
            $this->jumlah_pesanan->LinkCustomAttributes = "";
            $this->jumlah_pesanan->HrefValue = "";

            // lead_time
            $this->lead_time->LinkCustomAttributes = "";
            $this->lead_time->HrefValue = "";

            // pakai
            $this->pakai->LinkCustomAttributes = "";
            $this->pakai->HrefValue = "";
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
        if ($this->nama_pemesan->Required) {
            if (!$this->nama_pemesan->IsDetailKey && EmptyValue($this->nama_pemesan->FormValue)) {
                $this->nama_pemesan->addErrorMessage(str_replace("%s", $this->nama_pemesan->caption(), $this->nama_pemesan->RequiredErrorMessage));
            }
        }
        if ($this->id_barang->Required) {
            if (!$this->id_barang->IsDetailKey && EmptyValue($this->id_barang->FormValue)) {
                $this->id_barang->addErrorMessage(str_replace("%s", $this->id_barang->caption(), $this->id_barang->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->id_barang->FormValue)) {
            $this->id_barang->addErrorMessage($this->id_barang->getErrorMessage(false));
        }
        if ($this->jumlah_pesanan->Required) {
            if (!$this->jumlah_pesanan->IsDetailKey && EmptyValue($this->jumlah_pesanan->FormValue)) {
                $this->jumlah_pesanan->addErrorMessage(str_replace("%s", $this->jumlah_pesanan->caption(), $this->jumlah_pesanan->RequiredErrorMessage));
            }
        }
        if ($this->lead_time->Required) {
            if (!$this->lead_time->IsDetailKey && EmptyValue($this->lead_time->FormValue)) {
                $this->lead_time->addErrorMessage(str_replace("%s", $this->lead_time->caption(), $this->lead_time->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->lead_time->FormValue)) {
            $this->lead_time->addErrorMessage($this->lead_time->getErrorMessage(false));
        }
        if ($this->pakai->Required) {
            if (!$this->pakai->IsDetailKey && EmptyValue($this->pakai->FormValue)) {
                $this->pakai->addErrorMessage(str_replace("%s", $this->pakai->caption(), $this->pakai->RequiredErrorMessage));
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
        $conn = $this->getConnection();

        // Load db values from rsold
        $this->loadDbValues($rsold);
        if ($rsold) {
        }
        $rsnew = [];

        // nama_pemesan
        $this->nama_pemesan->setDbValueDef($rsnew, $this->nama_pemesan->CurrentValue, "", false);

        // id_barang
        $this->id_barang->setDbValueDef($rsnew, $this->id_barang->CurrentValue, 0, false);

        // jumlah_pesanan
        $this->jumlah_pesanan->setDbValueDef($rsnew, $this->jumlah_pesanan->CurrentValue, "", false);

        // lead_time
        $this->lead_time->setDbValueDef($rsnew, $this->lead_time->CurrentValue, 0, false);

        // pakai
        $this->pakai->setDbValueDef($rsnew, $this->pakai->CurrentValue, "", false);

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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("pemesananlist"), "", $this->TableVar, true);
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
