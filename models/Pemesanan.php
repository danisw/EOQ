<?php

namespace PHPMaker2021\eoq;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for pemesanan
 */
class Pemesanan extends DbTable
{
    protected $SqlFrom = "";
    protected $SqlSelect = null;
    protected $SqlSelectList = null;
    protected $SqlWhere = "";
    protected $SqlGroupBy = "";
    protected $SqlHaving = "";
    protected $SqlOrderBy = "";
    public $UseSessionForListSql = true;

    // Column CSS classes
    public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
    public $RightColumnClass = "col-sm-10";
    public $OffsetColumnClass = "col-sm-10 offset-sm-2";
    public $TableLeftColumnClass = "w-col-2";

    // Export
    public $ExportDoc;

    // Fields
    public $id_pesanan;
    public $nama_pemesan;
    public $id_barang;
    public $jumlah_pesanan;
    public $lead_time;
    public $pakai;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'pemesanan';
        $this->TableName = 'pemesanan';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`pemesanan`";
        $this->Dbid = 'DB';
        $this->ExportAll = true;
        $this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
        $this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
        $this->ExportPageSize = "a4"; // Page size (PDF only)
        $this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
        $this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
        $this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
        $this->ExportWordColumnWidth = null; // Cell width (PHPWord only)
        $this->DetailAdd = false; // Allow detail add
        $this->DetailEdit = false; // Allow detail edit
        $this->DetailView = false; // Allow detail view
        $this->ShowMultipleDetails = false; // Show multiple details
        $this->GridAddRowCount = 5;
        $this->AllowAddDeleteRow = true; // Allow add/delete row
        $this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
        $this->BasicSearch = new BasicSearch($this->TableVar);

        // id_pesanan
        $this->id_pesanan = new DbField('pemesanan', 'pemesanan', 'x_id_pesanan', 'id_pesanan', '`id_pesanan`', '`id_pesanan`', 3, 16, -1, false, '`id_pesanan`', false, false, false, 'FORMATTED TEXT', 'NO');
        $this->id_pesanan->IsAutoIncrement = true; // Autoincrement field
        $this->id_pesanan->IsPrimaryKey = true; // Primary key field
        $this->id_pesanan->Sortable = true; // Allow sort
        $this->id_pesanan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->id_pesanan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->id_pesanan->Param, "CustomMsg");
        $this->Fields['id_pesanan'] = &$this->id_pesanan;

        // nama_pemesan
        $this->nama_pemesan = new DbField('pemesanan', 'pemesanan', 'x_nama_pemesan', 'nama_pemesan', '`nama_pemesan`', '`nama_pemesan`', 200, 32, -1, false, '`nama_pemesan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->nama_pemesan->Nullable = false; // NOT NULL field
        $this->nama_pemesan->Required = true; // Required field
        $this->nama_pemesan->Sortable = true; // Allow sort
        $this->nama_pemesan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nama_pemesan->Param, "CustomMsg");
        $this->Fields['nama_pemesan'] = &$this->nama_pemesan;

        // id_barang
        $this->id_barang = new DbField('pemesanan', 'pemesanan', 'x_id_barang', 'id_barang', '`id_barang`', '`id_barang`', 3, 16, -1, false, '`id_barang`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->id_barang->Nullable = false; // NOT NULL field
        $this->id_barang->Required = true; // Required field
        $this->id_barang->Sortable = true; // Allow sort
        $this->id_barang->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->id_barang->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->id_barang->Param, "CustomMsg");
        $this->Fields['id_barang'] = &$this->id_barang;

        // jumlah_pesanan
        $this->jumlah_pesanan = new DbField('pemesanan', 'pemesanan', 'x_jumlah_pesanan', 'jumlah_pesanan', '`jumlah_pesanan`', '`jumlah_pesanan`', 200, 16, -1, false, '`jumlah_pesanan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->jumlah_pesanan->Nullable = false; // NOT NULL field
        $this->jumlah_pesanan->Required = true; // Required field
        $this->jumlah_pesanan->Sortable = true; // Allow sort
        $this->jumlah_pesanan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->jumlah_pesanan->Param, "CustomMsg");
        $this->Fields['jumlah_pesanan'] = &$this->jumlah_pesanan;

        // lead_time
        $this->lead_time = new DbField('pemesanan', 'pemesanan', 'x_lead_time', 'lead_time', '`lead_time`', '`lead_time`', 3, 4, -1, false, '`lead_time`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->lead_time->Nullable = false; // NOT NULL field
        $this->lead_time->Required = true; // Required field
        $this->lead_time->Sortable = true; // Allow sort
        $this->lead_time->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->lead_time->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->lead_time->Param, "CustomMsg");
        $this->Fields['lead_time'] = &$this->lead_time;

        // pakai
        $this->pakai = new DbField('pemesanan', 'pemesanan', 'x_pakai', 'pakai', '`pakai`', '`pakai`', 200, 8, -1, false, '`pakai`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pakai->Nullable = false; // NOT NULL field
        $this->pakai->Required = true; // Required field
        $this->pakai->Sortable = true; // Allow sort
        $this->pakai->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pakai->Param, "CustomMsg");
        $this->Fields['pakai'] = &$this->pakai;
    }

    // Field Visibility
    public function getFieldVisibility($fldParm)
    {
        global $Security;
        return $this->$fldParm->Visible; // Returns original value
    }

    // Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
    public function setLeftColumnClass($class)
    {
        if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
            $this->LeftColumnClass = $class . " col-form-label ew-label";
            $this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
            $this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
            $this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
        }
    }

    // Single column sort
    public function updateSort(&$fld)
    {
        if ($this->CurrentOrder == $fld->Name) {
            $sortField = $fld->Expression;
            $lastSort = $fld->getSort();
            if (in_array($this->CurrentOrderType, ["ASC", "DESC", "NO"])) {
                $curSort = $this->CurrentOrderType;
            } else {
                $curSort = $lastSort;
            }
            $fld->setSort($curSort);
            $orderBy = in_array($curSort, ["ASC", "DESC"]) ? $sortField . " " . $curSort : "";
            $this->setSessionOrderBy($orderBy); // Save to Session
        } else {
            $fld->setSort("");
        }
    }

    // Table level SQL
    public function getSqlFrom() // From
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`pemesanan`";
    }

    public function sqlFrom() // For backward compatibility
    {
        return $this->getSqlFrom();
    }

    public function setSqlFrom($v)
    {
        $this->SqlFrom = $v;
    }

    public function getSqlSelect() // Select
    {
        return $this->SqlSelect ?? $this->getQueryBuilder()->select("*");
    }

    public function sqlSelect() // For backward compatibility
    {
        return $this->getSqlSelect();
    }

    public function setSqlSelect($v)
    {
        $this->SqlSelect = $v;
    }

    public function getSqlWhere() // Where
    {
        $where = ($this->SqlWhere != "") ? $this->SqlWhere : "";
        $this->DefaultFilter = "";
        AddFilter($where, $this->DefaultFilter);
        return $where;
    }

    public function sqlWhere() // For backward compatibility
    {
        return $this->getSqlWhere();
    }

    public function setSqlWhere($v)
    {
        $this->SqlWhere = $v;
    }

    public function getSqlGroupBy() // Group By
    {
        return ($this->SqlGroupBy != "") ? $this->SqlGroupBy : "";
    }

    public function sqlGroupBy() // For backward compatibility
    {
        return $this->getSqlGroupBy();
    }

    public function setSqlGroupBy($v)
    {
        $this->SqlGroupBy = $v;
    }

    public function getSqlHaving() // Having
    {
        return ($this->SqlHaving != "") ? $this->SqlHaving : "";
    }

    public function sqlHaving() // For backward compatibility
    {
        return $this->getSqlHaving();
    }

    public function setSqlHaving($v)
    {
        $this->SqlHaving = $v;
    }

    public function getSqlOrderBy() // Order By
    {
        return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : $this->DefaultSort;
    }

    public function sqlOrderBy() // For backward compatibility
    {
        return $this->getSqlOrderBy();
    }

    public function setSqlOrderBy($v)
    {
        $this->SqlOrderBy = $v;
    }

    // Apply User ID filters
    public function applyUserIDFilters($filter)
    {
        return $filter;
    }

    // Check if User ID security allows view all
    public function userIDAllow($id = "")
    {
        $allow = $this->UserIDAllowSecurity;
        switch ($id) {
            case "add":
            case "copy":
            case "gridadd":
            case "register":
            case "addopt":
                return (($allow & 1) == 1);
            case "edit":
            case "gridedit":
            case "update":
            case "changepassword":
            case "resetpassword":
                return (($allow & 4) == 4);
            case "delete":
                return (($allow & 2) == 2);
            case "view":
                return (($allow & 32) == 32);
            case "search":
                return (($allow & 64) == 64);
            default:
                return (($allow & 8) == 8);
        }
    }

    /**
     * Get record count
     *
     * @param string|QueryBuilder $sql SQL or QueryBuilder
     * @param mixed $c Connection
     * @return int
     */
    public function getRecordCount($sql, $c = null)
    {
        $cnt = -1;
        $rs = null;
        if ($sql instanceof \Doctrine\DBAL\Query\QueryBuilder) { // Query builder
            $sqlwrk = clone $sql;
            $sqlwrk = $sqlwrk->resetQueryPart("orderBy")->getSQL();
        } else {
            $sqlwrk = $sql;
        }
        $pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';
        // Skip Custom View / SubQuery / SELECT DISTINCT / ORDER BY
        if (
            ($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
            preg_match($pattern, $sqlwrk) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sqlwrk) &&
            !preg_match('/^\s*select\s+distinct\s+/i', $sqlwrk) && !preg_match('/\s+order\s+by\s+/i', $sqlwrk)
        ) {
            $sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sqlwrk);
        } else {
            $sqlwrk = "SELECT COUNT(*) FROM (" . $sqlwrk . ") COUNT_TABLE";
        }
        $conn = $c ?? $this->getConnection();
        $rs = $conn->executeQuery($sqlwrk);
        $cnt = $rs->fetchColumn();
        if ($cnt !== false) {
            return (int)$cnt;
        }

        // Unable to get count by SELECT COUNT(*), execute the SQL to get record count directly
        return ExecuteRecordCount($sql, $conn);
    }

    // Get SQL
    public function getSql($where, $orderBy = "")
    {
        return $this->buildSelectSql(
            $this->getSqlSelect(),
            $this->getSqlFrom(),
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $where,
            $orderBy
        )->getSQL();
    }

    // Table SQL
    public function getCurrentSql()
    {
        $filter = $this->CurrentFilter;
        $filter = $this->applyUserIDFilters($filter);
        $sort = $this->getSessionOrderBy();
        return $this->getSql($filter, $sort);
    }

    /**
     * Table SQL with List page filter
     *
     * @return QueryBuilder
     */
    public function getListSql()
    {
        $filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        $select = $this->getSqlSelect();
        $from = $this->getSqlFrom();
        $sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
        $this->Sort = $sort;
        return $this->buildSelectSql(
            $select,
            $from,
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $filter,
            $sort
        );
    }

    // Get ORDER BY clause
    public function getOrderBy()
    {
        $orderBy = $this->getSqlOrderBy();
        $sort = $this->getSessionOrderBy();
        if ($orderBy != "" && $sort != "") {
            $orderBy .= ", " . $sort;
        } elseif ($sort != "") {
            $orderBy = $sort;
        }
        return $orderBy;
    }

    // Get record count based on filter (for detail record count in master table pages)
    public function loadRecordCount($filter)
    {
        $origFilter = $this->CurrentFilter;
        $this->CurrentFilter = $filter;
        $this->recordsetSelecting($this->CurrentFilter);
        $select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
        $having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
        $cnt = $this->getRecordCount($sql);
        $this->CurrentFilter = $origFilter;
        return $cnt;
    }

    // Get record count (for current List page)
    public function listRecordCount()
    {
        $filter = $this->getSessionWhere();
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        $select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
        $having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
        $cnt = $this->getRecordCount($sql);
        return $cnt;
    }

    /**
     * INSERT statement
     *
     * @param mixed $rs
     * @return QueryBuilder
     */
    protected function insertSql(&$rs)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->insert($this->UpdateTable);
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom) {
                continue;
            }
            $type = GetParameterType($this->Fields[$name], $value, $this->Dbid);
            $queryBuilder->setValue($this->Fields[$name]->Expression, $queryBuilder->createPositionalParameter($value, $type));
        }
        return $queryBuilder;
    }

    // Insert
    public function insert(&$rs)
    {
        $conn = $this->getConnection();
        $success = $this->insertSql($rs)->execute();
        if ($success) {
            // Get insert id if necessary
            $this->id_pesanan->setDbValue($conn->lastInsertId());
            $rs['id_pesanan'] = $this->id_pesanan->DbValue;
        }
        return $success;
    }

    /**
     * UPDATE statement
     *
     * @param array $rs Data to be updated
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    protected function updateSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->update($this->UpdateTable);
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom || $this->Fields[$name]->IsAutoIncrement) {
                continue;
            }
            $type = GetParameterType($this->Fields[$name], $value, $this->Dbid);
            $queryBuilder->set($this->Fields[$name]->Expression, $queryBuilder->createPositionalParameter($value, $type));
        }
        $filter = ($curfilter) ? $this->CurrentFilter : "";
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        AddFilter($filter, $where);
        if ($filter != "") {
            $queryBuilder->where($filter);
        }
        return $queryBuilder;
    }

    // Update
    public function update(&$rs, $where = "", $rsold = null, $curfilter = true)
    {
        // If no field is updated, execute may return 0. Treat as success
        $success = $this->updateSql($rs, $where, $curfilter)->execute();
        $success = ($success > 0) ? $success : true;
        return $success;
    }

    /**
     * DELETE statement
     *
     * @param array $rs Key values
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    protected function deleteSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->delete($this->UpdateTable);
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        if ($rs) {
            if (array_key_exists('id_pesanan', $rs)) {
                AddFilter($where, QuotedName('id_pesanan', $this->Dbid) . '=' . QuotedValue($rs['id_pesanan'], $this->id_pesanan->DataType, $this->Dbid));
            }
        }
        $filter = ($curfilter) ? $this->CurrentFilter : "";
        AddFilter($filter, $where);
        return $queryBuilder->where($filter != "" ? $filter : "0=1");
    }

    // Delete
    public function delete(&$rs, $where = "", $curfilter = false)
    {
        $success = true;
        if ($success) {
            $success = $this->deleteSql($rs, $where, $curfilter)->execute();
        }
        return $success;
    }

    // Load DbValue from recordset or array
    protected function loadDbValues($row)
    {
        if (!is_array($row)) {
            return;
        }
        $this->id_pesanan->DbValue = $row['id_pesanan'];
        $this->nama_pemesan->DbValue = $row['nama_pemesan'];
        $this->id_barang->DbValue = $row['id_barang'];
        $this->jumlah_pesanan->DbValue = $row['jumlah_pesanan'];
        $this->lead_time->DbValue = $row['lead_time'];
        $this->pakai->DbValue = $row['pakai'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "`id_pesanan` = @id_pesanan@";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->id_pesanan->CurrentValue : $this->id_pesanan->OldValue;
        if (EmptyValue($val)) {
            return "";
        } else {
            $keys[] = $val;
        }
        return implode(Config("COMPOSITE_KEY_SEPARATOR"), $keys);
    }

    // Set Key
    public function setKey($key, $current = false)
    {
        $this->OldKey = strval($key);
        $keys = explode(Config("COMPOSITE_KEY_SEPARATOR"), $this->OldKey);
        if (count($keys) == 1) {
            if ($current) {
                $this->id_pesanan->CurrentValue = $keys[0];
            } else {
                $this->id_pesanan->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('id_pesanan', $row) ? $row['id_pesanan'] : null;
        } else {
            $val = $this->id_pesanan->OldValue !== null ? $this->id_pesanan->OldValue : $this->id_pesanan->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@id_pesanan@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
        }
        return $keyFilter;
    }

    // Return page URL
    public function getReturnUrl()
    {
        $referUrl = ReferUrl();
        $referPageName = ReferPageName();
        $name = PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL");
        // Get referer URL automatically
        if ($referUrl != "" && $referPageName != CurrentPageName() && $referPageName != "login") { // Referer not same page or login page
            $_SESSION[$name] = $referUrl; // Save to Session
        }
        return $_SESSION[$name] ?? GetUrl("pemesananlist");
    }

    // Set return page URL
    public function setReturnUrl($v)
    {
        $_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL")] = $v;
    }

    // Get modal caption
    public function getModalCaption($pageName)
    {
        global $Language;
        if ($pageName == "pemesananview") {
            return $Language->phrase("View");
        } elseif ($pageName == "pemesananedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "pemesananadd") {
            return $Language->phrase("Add");
        } else {
            return "";
        }
    }

    // API page name
    public function getApiPageName($action)
    {
        switch (strtolower($action)) {
            case Config("API_VIEW_ACTION"):
                return "PemesananView";
            case Config("API_ADD_ACTION"):
                return "PemesananAdd";
            case Config("API_EDIT_ACTION"):
                return "PemesananEdit";
            case Config("API_DELETE_ACTION"):
                return "PemesananDelete";
            case Config("API_LIST_ACTION"):
                return "PemesananList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "pemesananlist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("pemesananview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("pemesananview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "pemesananadd?" . $this->getUrlParm($parm);
        } else {
            $url = "pemesananadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("pemesananedit", $this->getUrlParm($parm));
        return $this->addMasterUrl($url);
    }

    // Inline edit URL
    public function getInlineEditUrl()
    {
        $url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=edit"));
        return $this->addMasterUrl($url);
    }

    // Copy URL
    public function getCopyUrl($parm = "")
    {
        $url = $this->keyUrl("pemesananadd", $this->getUrlParm($parm));
        return $this->addMasterUrl($url);
    }

    // Inline copy URL
    public function getInlineCopyUrl()
    {
        $url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=copy"));
        return $this->addMasterUrl($url);
    }

    // Delete URL
    public function getDeleteUrl()
    {
        return $this->keyUrl("pemesanandelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "id_pesanan:" . JsonEncode($this->id_pesanan->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->id_pesanan->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->id_pesanan->CurrentValue);
        } else {
            return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
        }
        if ($parm != "") {
            $url .= "?" . $parm;
        }
        return $url;
    }

    // Render sort
    public function renderSort($fld)
    {
        $classId = $fld->TableVar . "_" . $fld->Param;
        $scriptId = str_replace("%id%", $classId, "tpc_%id%");
        $scriptStart = $this->UseCustomTemplate ? "<template id=\"" . $scriptId . "\">" : "";
        $scriptEnd = $this->UseCustomTemplate ? "</template>" : "";
        $jsSort = " class=\"ew-pointer\" onclick=\"ew.sort(event, '" . $this->sortUrl($fld) . "', 1);\"";
        if ($this->sortUrl($fld) == "") {
            $html = <<<NOSORTHTML
{$scriptStart}<div class="ew-table-header-caption">{$fld->caption()}</div>{$scriptEnd}
NOSORTHTML;
        } else {
            if ($fld->getSort() == "ASC") {
                $sortIcon = '<i class="fas fa-sort-up"></i>';
            } elseif ($fld->getSort() == "DESC") {
                $sortIcon = '<i class="fas fa-sort-down"></i>';
            } else {
                $sortIcon = '';
            }
            $html = <<<SORTHTML
{$scriptStart}<div{$jsSort}><div class="ew-table-header-btn"><span class="ew-table-header-caption">{$fld->caption()}</span><span class="ew-table-header-sort">{$sortIcon}</span></div></div>{$scriptEnd}
SORTHTML;
        }
        return $html;
    }

    // Sort URL
    public function sortUrl($fld)
    {
        if (
            $this->CurrentAction || $this->isExport() ||
            in_array($fld->Type, [128, 204, 205])
        ) { // Unsortable data type
                return "";
        } elseif ($fld->Sortable) {
            $urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->getNextSort());
            return $this->addMasterUrl(CurrentPageName() . "?" . $urlParm);
        } else {
            return "";
        }
    }

    // Get record keys from Post/Get/Session
    public function getRecordKeys()
    {
        $arKeys = [];
        $arKey = [];
        if (Param("key_m") !== null) {
            $arKeys = Param("key_m");
            $cnt = count($arKeys);
        } else {
            if (($keyValue = Param("id_pesanan") ?? Route("id_pesanan")) !== null) {
                $arKeys[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(0) ?? Route(2)) !== null)) {
                $arKeys[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }

            //return $arKeys; // Do not return yet, so the values will also be checked by the following code
        }
        // Check keys
        $ar = [];
        if (is_array($arKeys)) {
            foreach ($arKeys as $key) {
                if (!is_numeric($key)) {
                    continue;
                }
                $ar[] = $key;
            }
        }
        return $ar;
    }

    // Get filter from record keys
    public function getFilterFromRecordKeys($setCurrent = true)
    {
        $arKeys = $this->getRecordKeys();
        $keyFilter = "";
        foreach ($arKeys as $key) {
            if ($keyFilter != "") {
                $keyFilter .= " OR ";
            }
            if ($setCurrent) {
                $this->id_pesanan->CurrentValue = $key;
            } else {
                $this->id_pesanan->OldValue = $key;
            }
            $keyFilter .= "(" . $this->getRecordFilter() . ")";
        }
        return $keyFilter;
    }

    // Load recordset based on filter
    public function &loadRs($filter)
    {
        $sql = $this->getSql($filter); // Set up filter (WHERE Clause)
        $conn = $this->getConnection();
        $stmt = $conn->executeQuery($sql);
        return $stmt;
    }

    // Load row values from record
    public function loadListRowValues(&$rs)
    {
        if (is_array($rs)) {
            $row = $rs;
        } elseif ($rs && property_exists($rs, "fields")) { // Recordset
            $row = $rs->fields;
        } else {
            return;
        }
        $this->id_pesanan->setDbValue($row['id_pesanan']);
        $this->nama_pemesan->setDbValue($row['nama_pemesan']);
        $this->id_barang->setDbValue($row['id_barang']);
        $this->jumlah_pesanan->setDbValue($row['jumlah_pesanan']);
        $this->lead_time->setDbValue($row['lead_time']);
        $this->pakai->setDbValue($row['pakai']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // id_pesanan

        // nama_pemesan

        // id_barang

        // jumlah_pesanan

        // lead_time

        // pakai

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

        // id_pesanan
        $this->id_pesanan->LinkCustomAttributes = "";
        $this->id_pesanan->HrefValue = "";
        $this->id_pesanan->TooltipValue = "";

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

        // Call Row Rendered event
        $this->rowRendered();

        // Save data for Custom Template
        $this->Rows[] = $this->customTemplateFieldValues();
    }

    // Render edit row values
    public function renderEditRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // id_pesanan
        $this->id_pesanan->EditAttrs["class"] = "form-control";
        $this->id_pesanan->EditCustomAttributes = "";
        $this->id_pesanan->EditValue = $this->id_pesanan->CurrentValue;
        $this->id_pesanan->ViewCustomAttributes = "";

        // nama_pemesan
        $this->nama_pemesan->EditAttrs["class"] = "form-control";
        $this->nama_pemesan->EditCustomAttributes = "";
        if (!$this->nama_pemesan->Raw) {
            $this->nama_pemesan->CurrentValue = HtmlDecode($this->nama_pemesan->CurrentValue);
        }
        $this->nama_pemesan->EditValue = $this->nama_pemesan->CurrentValue;
        $this->nama_pemesan->PlaceHolder = RemoveHtml($this->nama_pemesan->caption());

        // id_barang
        $this->id_barang->EditAttrs["class"] = "form-control";
        $this->id_barang->EditCustomAttributes = "";
        $this->id_barang->EditValue = $this->id_barang->CurrentValue;
        $this->id_barang->PlaceHolder = RemoveHtml($this->id_barang->caption());

        // jumlah_pesanan
        $this->jumlah_pesanan->EditAttrs["class"] = "form-control";
        $this->jumlah_pesanan->EditCustomAttributes = "";
        if (!$this->jumlah_pesanan->Raw) {
            $this->jumlah_pesanan->CurrentValue = HtmlDecode($this->jumlah_pesanan->CurrentValue);
        }
        $this->jumlah_pesanan->EditValue = $this->jumlah_pesanan->CurrentValue;
        $this->jumlah_pesanan->PlaceHolder = RemoveHtml($this->jumlah_pesanan->caption());

        // lead_time
        $this->lead_time->EditAttrs["class"] = "form-control";
        $this->lead_time->EditCustomAttributes = "";
        $this->lead_time->EditValue = $this->lead_time->CurrentValue;
        $this->lead_time->PlaceHolder = RemoveHtml($this->lead_time->caption());

        // pakai
        $this->pakai->EditAttrs["class"] = "form-control";
        $this->pakai->EditCustomAttributes = "";
        if (!$this->pakai->Raw) {
            $this->pakai->CurrentValue = HtmlDecode($this->pakai->CurrentValue);
        }
        $this->pakai->EditValue = $this->pakai->CurrentValue;
        $this->pakai->PlaceHolder = RemoveHtml($this->pakai->caption());

        // Call Row Rendered event
        $this->rowRendered();
    }

    // Aggregate list row values
    public function aggregateListRowValues()
    {
    }

    // Aggregate list row (for rendering)
    public function aggregateListRow()
    {
        // Call Row Rendered event
        $this->rowRendered();
    }

    // Export data in HTML/CSV/Word/Excel/Email/PDF format
    public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
    {
        if (!$recordset || !$doc) {
            return;
        }
        if (!$doc->ExportCustom) {
            // Write header
            $doc->exportTableHeader();
            if ($doc->Horizontal) { // Horizontal format, write header
                $doc->beginExportRow();
                if ($exportPageType == "view") {
                    $doc->exportCaption($this->id_pesanan);
                    $doc->exportCaption($this->nama_pemesan);
                    $doc->exportCaption($this->id_barang);
                    $doc->exportCaption($this->jumlah_pesanan);
                    $doc->exportCaption($this->lead_time);
                    $doc->exportCaption($this->pakai);
                } else {
                    $doc->exportCaption($this->id_pesanan);
                    $doc->exportCaption($this->nama_pemesan);
                    $doc->exportCaption($this->id_barang);
                    $doc->exportCaption($this->jumlah_pesanan);
                    $doc->exportCaption($this->lead_time);
                    $doc->exportCaption($this->pakai);
                }
                $doc->endExportRow();
            }
        }

        // Move to first record
        $recCnt = $startRec - 1;
        $stopRec = ($stopRec > 0) ? $stopRec : PHP_INT_MAX;
        while (!$recordset->EOF && $recCnt < $stopRec) {
            $row = $recordset->fields;
            $recCnt++;
            if ($recCnt >= $startRec) {
                $rowCnt = $recCnt - $startRec + 1;

                // Page break
                if ($this->ExportPageBreakCount > 0) {
                    if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0) {
                        $doc->exportPageBreak();
                    }
                }
                $this->loadListRowValues($row);

                // Render row
                $this->RowType = ROWTYPE_VIEW; // Render view
                $this->resetAttributes();
                $this->renderListRow();
                if (!$doc->ExportCustom) {
                    $doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
                    if ($exportPageType == "view") {
                        $doc->exportField($this->id_pesanan);
                        $doc->exportField($this->nama_pemesan);
                        $doc->exportField($this->id_barang);
                        $doc->exportField($this->jumlah_pesanan);
                        $doc->exportField($this->lead_time);
                        $doc->exportField($this->pakai);
                    } else {
                        $doc->exportField($this->id_pesanan);
                        $doc->exportField($this->nama_pemesan);
                        $doc->exportField($this->id_barang);
                        $doc->exportField($this->jumlah_pesanan);
                        $doc->exportField($this->lead_time);
                        $doc->exportField($this->pakai);
                    }
                    $doc->endExportRow($rowCnt);
                }
            }

            // Call Row Export server event
            if ($doc->ExportCustom) {
                $this->rowExport($row);
            }
            $recordset->moveNext();
        }
        if (!$doc->ExportCustom) {
            $doc->exportTableFooter();
        }
    }

    // Get file data
    public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0, $plugins = [])
    {
        // No binary fields
        return false;
    }

    // Table level events

    // Recordset Selecting event
    public function recordsetSelecting(&$filter)
    {
        // Enter your code here
    }

    // Recordset Selected event
    public function recordsetSelected(&$rs)
    {
        //Log("Recordset Selected");
    }

    // Recordset Search Validated event
    public function recordsetSearchValidated()
    {
        // Example:
        //$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value
    }

    // Recordset Searching event
    public function recordsetSearching(&$filter)
    {
        // Enter your code here
    }

    // Row_Selecting event
    public function rowSelecting(&$filter)
    {
        // Enter your code here
    }

    // Row Selected event
    public function rowSelected(&$rs)
    {
        //Log("Row Selected");
    }

    // Row Inserting event
    public function rowInserting($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }

    // Row Inserted event
    public function rowInserted($rsold, &$rsnew)
    {
        //Log("Row Inserted");
    }

    // Row Updating event
    public function rowUpdating($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }

    // Row Updated event
    public function rowUpdated($rsold, &$rsnew)
    {
        //Log("Row Updated");
    }

    // Row Update Conflict event
    public function rowUpdateConflict($rsold, &$rsnew)
    {
        // Enter your code here
        // To ignore conflict, set return value to false
        return true;
    }

    // Grid Inserting event
    public function gridInserting()
    {
        // Enter your code here
        // To reject grid insert, set return value to false
        return true;
    }

    // Grid Inserted event
    public function gridInserted($rsnew)
    {
        //Log("Grid Inserted");
    }

    // Grid Updating event
    public function gridUpdating($rsold)
    {
        // Enter your code here
        // To reject grid update, set return value to false
        return true;
    }

    // Grid Updated event
    public function gridUpdated($rsold, $rsnew)
    {
        //Log("Grid Updated");
    }

    // Row Deleting event
    public function rowDeleting(&$rs)
    {
        // Enter your code here
        // To cancel, set return value to False
        return true;
    }

    // Row Deleted event
    public function rowDeleted(&$rs)
    {
        //Log("Row Deleted");
    }

    // Email Sending event
    public function emailSending($email, &$args)
    {
        //var_dump($email); var_dump($args); exit();
        return true;
    }

    // Lookup Selecting event
    public function lookupSelecting($fld, &$filter)
    {
        //var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
        // Enter your code here
    }

    // Row Rendering event
    public function rowRendering()
    {
        // Enter your code here
    }

    // Row Rendered event
    public function rowRendered()
    {
        // To view properties of field class, use:
        //var_dump($this-><FieldName>);
    }

    // User ID Filtering event
    public function userIdFiltering(&$filter)
    {
        // Enter your code here
    }
}
