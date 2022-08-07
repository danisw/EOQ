<?php

namespace PHPMaker2021\eoq;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for barang
 */
class Barang extends DbTable
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
    public $id_barang;
    public $nama_barang;
    public $harga_barang;
    public $biaya_penyimpanan;
    public $periode_permintaan;
    public $satuan;
    public $konversi;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'barang';
        $this->TableName = 'barang';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`barang`";
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

        // id_barang
        $this->id_barang = new DbField('barang', 'barang', 'x_id_barang', 'id_barang', '`id_barang`', '`id_barang`', 3, 16, -1, false, '`id_barang`', false, false, false, 'FORMATTED TEXT', 'NO');
        $this->id_barang->IsAutoIncrement = true; // Autoincrement field
        $this->id_barang->IsPrimaryKey = true; // Primary key field
        $this->id_barang->Sortable = true; // Allow sort
        $this->id_barang->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->id_barang->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->id_barang->Param, "CustomMsg");
        $this->Fields['id_barang'] = &$this->id_barang;

        // nama_barang
        $this->nama_barang = new DbField('barang', 'barang', 'x_nama_barang', 'nama_barang', '`nama_barang`', '`nama_barang`', 200, 64, -1, false, '`nama_barang`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->nama_barang->Nullable = false; // NOT NULL field
        $this->nama_barang->Required = true; // Required field
        $this->nama_barang->Sortable = true; // Allow sort
        $this->nama_barang->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nama_barang->Param, "CustomMsg");
        $this->Fields['nama_barang'] = &$this->nama_barang;

        // harga_barang
        $this->harga_barang = new DbField('barang', 'barang', 'x_harga_barang', 'harga_barang', '`harga_barang`', '`harga_barang`', 200, 16, -1, false, '`harga_barang`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->harga_barang->Nullable = false; // NOT NULL field
        $this->harga_barang->Required = true; // Required field
        $this->harga_barang->Sortable = true; // Allow sort
        $this->harga_barang->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->harga_barang->Param, "CustomMsg");
        $this->Fields['harga_barang'] = &$this->harga_barang;

        // biaya_penyimpanan
        $this->biaya_penyimpanan = new DbField('barang', 'barang', 'x_biaya_penyimpanan', 'biaya_penyimpanan', '`biaya_penyimpanan`', '`biaya_penyimpanan`', 200, 16, -1, false, '`biaya_penyimpanan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->biaya_penyimpanan->Nullable = false; // NOT NULL field
        $this->biaya_penyimpanan->Required = true; // Required field
        $this->biaya_penyimpanan->Sortable = true; // Allow sort
        $this->biaya_penyimpanan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->biaya_penyimpanan->Param, "CustomMsg");
        $this->Fields['biaya_penyimpanan'] = &$this->biaya_penyimpanan;

        // periode_permintaan
        $this->periode_permintaan = new DbField('barang', 'barang', 'x_periode_permintaan', 'periode_permintaan', '`periode_permintaan`', '`periode_permintaan`', 200, 4, -1, false, '`periode_permintaan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->periode_permintaan->Nullable = false; // NOT NULL field
        $this->periode_permintaan->Required = true; // Required field
        $this->periode_permintaan->Sortable = true; // Allow sort
        $this->periode_permintaan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->periode_permintaan->Param, "CustomMsg");
        $this->Fields['periode_permintaan'] = &$this->periode_permintaan;

        // satuan
        $this->satuan = new DbField('barang', 'barang', 'x_satuan', 'satuan', '`satuan`', '`satuan`', 200, 16, -1, false, '`satuan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->satuan->Nullable = false; // NOT NULL field
        $this->satuan->Required = true; // Required field
        $this->satuan->Sortable = true; // Allow sort
        $this->satuan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->satuan->Param, "CustomMsg");
        $this->Fields['satuan'] = &$this->satuan;

        // konversi
        $this->konversi = new DbField('barang', 'barang', 'x_konversi', 'konversi', '`konversi`', '`konversi`', 200, 16, -1, false, '`konversi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->konversi->Nullable = false; // NOT NULL field
        $this->konversi->Required = true; // Required field
        $this->konversi->Sortable = true; // Allow sort
        $this->konversi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->konversi->Param, "CustomMsg");
        $this->Fields['konversi'] = &$this->konversi;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`barang`";
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
            $this->id_barang->setDbValue($conn->lastInsertId());
            $rs['id_barang'] = $this->id_barang->DbValue;
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
            if (array_key_exists('id_barang', $rs)) {
                AddFilter($where, QuotedName('id_barang', $this->Dbid) . '=' . QuotedValue($rs['id_barang'], $this->id_barang->DataType, $this->Dbid));
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
        $this->id_barang->DbValue = $row['id_barang'];
        $this->nama_barang->DbValue = $row['nama_barang'];
        $this->harga_barang->DbValue = $row['harga_barang'];
        $this->biaya_penyimpanan->DbValue = $row['biaya_penyimpanan'];
        $this->periode_permintaan->DbValue = $row['periode_permintaan'];
        $this->satuan->DbValue = $row['satuan'];
        $this->konversi->DbValue = $row['konversi'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "`id_barang` = @id_barang@";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->id_barang->CurrentValue : $this->id_barang->OldValue;
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
                $this->id_barang->CurrentValue = $keys[0];
            } else {
                $this->id_barang->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('id_barang', $row) ? $row['id_barang'] : null;
        } else {
            $val = $this->id_barang->OldValue !== null ? $this->id_barang->OldValue : $this->id_barang->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@id_barang@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("baranglist");
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
        if ($pageName == "barangview") {
            return $Language->phrase("View");
        } elseif ($pageName == "barangedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "barangadd") {
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
                return "BarangView";
            case Config("API_ADD_ACTION"):
                return "BarangAdd";
            case Config("API_EDIT_ACTION"):
                return "BarangEdit";
            case Config("API_DELETE_ACTION"):
                return "BarangDelete";
            case Config("API_LIST_ACTION"):
                return "BarangList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "baranglist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("barangview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("barangview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "barangadd?" . $this->getUrlParm($parm);
        } else {
            $url = "barangadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("barangedit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("barangadd", $this->getUrlParm($parm));
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
        return $this->keyUrl("barangdelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "id_barang:" . JsonEncode($this->id_barang->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->id_barang->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->id_barang->CurrentValue);
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
            if (($keyValue = Param("id_barang") ?? Route("id_barang")) !== null) {
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
                $this->id_barang->CurrentValue = $key;
            } else {
                $this->id_barang->OldValue = $key;
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
        $this->id_barang->setDbValue($row['id_barang']);
        $this->nama_barang->setDbValue($row['nama_barang']);
        $this->harga_barang->setDbValue($row['harga_barang']);
        $this->biaya_penyimpanan->setDbValue($row['biaya_penyimpanan']);
        $this->periode_permintaan->setDbValue($row['periode_permintaan']);
        $this->satuan->setDbValue($row['satuan']);
        $this->konversi->setDbValue($row['konversi']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // id_barang

        // nama_barang

        // harga_barang

        // biaya_penyimpanan

        // periode_permintaan

        // satuan

        // konversi

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

        // id_barang
        $this->id_barang->LinkCustomAttributes = "";
        $this->id_barang->HrefValue = "";
        $this->id_barang->TooltipValue = "";

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

        // id_barang
        $this->id_barang->EditAttrs["class"] = "form-control";
        $this->id_barang->EditCustomAttributes = "";
        $this->id_barang->EditValue = $this->id_barang->CurrentValue;
        $this->id_barang->ViewCustomAttributes = "";

        // nama_barang
        $this->nama_barang->EditAttrs["class"] = "form-control";
        $this->nama_barang->EditCustomAttributes = "";
        if (!$this->nama_barang->Raw) {
            $this->nama_barang->CurrentValue = HtmlDecode($this->nama_barang->CurrentValue);
        }
        $this->nama_barang->EditValue = $this->nama_barang->CurrentValue;
        $this->nama_barang->PlaceHolder = RemoveHtml($this->nama_barang->caption());

        // harga_barang
        $this->harga_barang->EditAttrs["class"] = "form-control";
        $this->harga_barang->EditCustomAttributes = "";
        if (!$this->harga_barang->Raw) {
            $this->harga_barang->CurrentValue = HtmlDecode($this->harga_barang->CurrentValue);
        }
        $this->harga_barang->EditValue = $this->harga_barang->CurrentValue;
        $this->harga_barang->PlaceHolder = RemoveHtml($this->harga_barang->caption());

        // biaya_penyimpanan
        $this->biaya_penyimpanan->EditAttrs["class"] = "form-control";
        $this->biaya_penyimpanan->EditCustomAttributes = "";
        if (!$this->biaya_penyimpanan->Raw) {
            $this->biaya_penyimpanan->CurrentValue = HtmlDecode($this->biaya_penyimpanan->CurrentValue);
        }
        $this->biaya_penyimpanan->EditValue = $this->biaya_penyimpanan->CurrentValue;
        $this->biaya_penyimpanan->PlaceHolder = RemoveHtml($this->biaya_penyimpanan->caption());

        // periode_permintaan
        $this->periode_permintaan->EditAttrs["class"] = "form-control";
        $this->periode_permintaan->EditCustomAttributes = "";
        if (!$this->periode_permintaan->Raw) {
            $this->periode_permintaan->CurrentValue = HtmlDecode($this->periode_permintaan->CurrentValue);
        }
        $this->periode_permintaan->EditValue = $this->periode_permintaan->CurrentValue;
        $this->periode_permintaan->PlaceHolder = RemoveHtml($this->periode_permintaan->caption());

        // satuan
        $this->satuan->EditAttrs["class"] = "form-control";
        $this->satuan->EditCustomAttributes = "";
        if (!$this->satuan->Raw) {
            $this->satuan->CurrentValue = HtmlDecode($this->satuan->CurrentValue);
        }
        $this->satuan->EditValue = $this->satuan->CurrentValue;
        $this->satuan->PlaceHolder = RemoveHtml($this->satuan->caption());

        // konversi
        $this->konversi->EditAttrs["class"] = "form-control";
        $this->konversi->EditCustomAttributes = "";
        if (!$this->konversi->Raw) {
            $this->konversi->CurrentValue = HtmlDecode($this->konversi->CurrentValue);
        }
        $this->konversi->EditValue = $this->konversi->CurrentValue;
        $this->konversi->PlaceHolder = RemoveHtml($this->konversi->caption());

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
                    $doc->exportCaption($this->id_barang);
                    $doc->exportCaption($this->nama_barang);
                    $doc->exportCaption($this->harga_barang);
                    $doc->exportCaption($this->biaya_penyimpanan);
                    $doc->exportCaption($this->periode_permintaan);
                    $doc->exportCaption($this->satuan);
                    $doc->exportCaption($this->konversi);
                } else {
                    $doc->exportCaption($this->id_barang);
                    $doc->exportCaption($this->nama_barang);
                    $doc->exportCaption($this->harga_barang);
                    $doc->exportCaption($this->biaya_penyimpanan);
                    $doc->exportCaption($this->periode_permintaan);
                    $doc->exportCaption($this->satuan);
                    $doc->exportCaption($this->konversi);
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
                        $doc->exportField($this->id_barang);
                        $doc->exportField($this->nama_barang);
                        $doc->exportField($this->harga_barang);
                        $doc->exportField($this->biaya_penyimpanan);
                        $doc->exportField($this->periode_permintaan);
                        $doc->exportField($this->satuan);
                        $doc->exportField($this->konversi);
                    } else {
                        $doc->exportField($this->id_barang);
                        $doc->exportField($this->nama_barang);
                        $doc->exportField($this->harga_barang);
                        $doc->exportField($this->biaya_penyimpanan);
                        $doc->exportField($this->periode_permintaan);
                        $doc->exportField($this->satuan);
                        $doc->exportField($this->konversi);
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
