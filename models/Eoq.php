<?php

namespace PHPMaker2021\eoq;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for eoq
 */
class Eoq extends DbTable
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
    public $nama_barang;
    public $harga_barang;
    public $konversi;
    public $D;
    public $pesan;
    public $H;
    public $C;
    public $R;
    public $EOQ;
    public $kuantitas;
    public $pembelian_optimum;
    public $daur_pembelian;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'eoq';
        $this->TableName = 'eoq';
        $this->TableType = 'VIEW';

        // Update Table
        $this->UpdateTable = "`eoq`";
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

        // nama_barang
        $this->nama_barang = new DbField('eoq', 'eoq', 'x_nama_barang', 'nama_barang', '`nama_barang`', '`nama_barang`', 200, 64, -1, false, '`nama_barang`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->nama_barang->Nullable = false; // NOT NULL field
        $this->nama_barang->Required = true; // Required field
        $this->nama_barang->Sortable = true; // Allow sort
        $this->nama_barang->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nama_barang->Param, "CustomMsg");
        $this->Fields['nama_barang'] = &$this->nama_barang;

        // harga_barang
        $this->harga_barang = new DbField('eoq', 'eoq', 'x_harga_barang', 'harga_barang', '`harga_barang`', '`harga_barang`', 200, 16, -1, false, '`harga_barang`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->harga_barang->Nullable = false; // NOT NULL field
        $this->harga_barang->Required = true; // Required field
        $this->harga_barang->Sortable = true; // Allow sort
        $this->harga_barang->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->harga_barang->Param, "CustomMsg");
        $this->Fields['harga_barang'] = &$this->harga_barang;

        // konversi
        $this->konversi = new DbField('eoq', 'eoq', 'x_konversi', 'konversi', '`konversi`', '`konversi`', 200, 16, -1, false, '`konversi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->konversi->Nullable = false; // NOT NULL field
        $this->konversi->Required = true; // Required field
        $this->konversi->Sortable = true; // Allow sort
        $this->konversi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->konversi->Param, "CustomMsg");
        $this->Fields['konversi'] = &$this->konversi;

        // D
        $this->D = new DbField('eoq', 'eoq', 'x_D', 'D', '`D`', '`D`', 5, 23, -1, false, '`D`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->D->Sortable = true; // Allow sort
        $this->D->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->D->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->D->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->D->Param, "CustomMsg");
        $this->Fields['D'] = &$this->D;

        // pesan
        $this->pesan = new DbField('eoq', 'eoq', 'x_pesan', 'pesan', '`pesan`', '`pesan`', 5, 23, -1, false, '`pesan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pesan->Sortable = true; // Allow sort
        $this->pesan->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->pesan->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->pesan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pesan->Param, "CustomMsg");
        $this->Fields['pesan'] = &$this->pesan;

        // H
        $this->H = new DbField('eoq', 'eoq', 'x_H', 'H', '`H`', '`H`', 200, 16, -1, false, '`H`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->H->Nullable = false; // NOT NULL field
        $this->H->Required = true; // Required field
        $this->H->Sortable = true; // Allow sort
        $this->H->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->H->Param, "CustomMsg");
        $this->Fields['H'] = &$this->H;

        // C
        $this->C = new DbField('eoq', 'eoq', 'x_C', 'C', '`C`', '`C`', 5, 19, -1, false, '`C`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->C->Sortable = true; // Allow sort
        $this->C->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->C->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->C->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->C->Param, "CustomMsg");
        $this->Fields['C'] = &$this->C;

        // R
        $this->R = new DbField('eoq', 'eoq', 'x_R', 'R', '`R`', '`R`', 5, 20, -1, false, '`R`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->R->Sortable = true; // Allow sort
        $this->R->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->R->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->R->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->R->Param, "CustomMsg");
        $this->Fields['R'] = &$this->R;

        // EOQ
        $this->EOQ = new DbField('eoq', 'eoq', 'x_EOQ', 'EOQ', '`EOQ`', '`EOQ`', 5, 20, -1, false, '`EOQ`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->EOQ->Sortable = true; // Allow sort
        $this->EOQ->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->EOQ->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->EOQ->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->EOQ->Param, "CustomMsg");
        $this->Fields['EOQ'] = &$this->EOQ;

        // kuantitas
        $this->kuantitas = new DbField('eoq', 'eoq', 'x_kuantitas', 'kuantitas', '`kuantitas`', '`kuantitas`', 5, 23, -1, false, '`kuantitas`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kuantitas->Sortable = true; // Allow sort
        $this->kuantitas->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->kuantitas->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->kuantitas->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kuantitas->Param, "CustomMsg");
        $this->Fields['kuantitas'] = &$this->kuantitas;

        // pembelian_optimum
        $this->pembelian_optimum = new DbField('eoq', 'eoq', 'x_pembelian_optimum', 'pembelian_optimum', '`pembelian_optimum`', '`pembelian_optimum`', 5, 20, -1, false, '`pembelian_optimum`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pembelian_optimum->Sortable = true; // Allow sort
        $this->pembelian_optimum->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->pembelian_optimum->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->pembelian_optimum->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pembelian_optimum->Param, "CustomMsg");
        $this->Fields['pembelian_optimum'] = &$this->pembelian_optimum;

        // daur_pembelian
        $this->daur_pembelian = new DbField('eoq', 'eoq', 'x_daur_pembelian', 'daur_pembelian', '`daur_pembelian`', '`daur_pembelian`', 5, 20, -1, false, '`daur_pembelian`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->daur_pembelian->Sortable = true; // Allow sort
        $this->daur_pembelian->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->daur_pembelian->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->daur_pembelian->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->daur_pembelian->Param, "CustomMsg");
        $this->Fields['daur_pembelian'] = &$this->daur_pembelian;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`eoq`";
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
        $this->nama_barang->DbValue = $row['nama_barang'];
        $this->harga_barang->DbValue = $row['harga_barang'];
        $this->konversi->DbValue = $row['konversi'];
        $this->D->DbValue = $row['D'];
        $this->pesan->DbValue = $row['pesan'];
        $this->H->DbValue = $row['H'];
        $this->C->DbValue = $row['C'];
        $this->R->DbValue = $row['R'];
        $this->EOQ->DbValue = $row['EOQ'];
        $this->kuantitas->DbValue = $row['kuantitas'];
        $this->pembelian_optimum->DbValue = $row['pembelian_optimum'];
        $this->daur_pembelian->DbValue = $row['daur_pembelian'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        return implode(Config("COMPOSITE_KEY_SEPARATOR"), $keys);
    }

    // Set Key
    public function setKey($key, $current = false)
    {
        $this->OldKey = strval($key);
        $keys = explode(Config("COMPOSITE_KEY_SEPARATOR"), $this->OldKey);
        if (count($keys) == 0) {
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
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
        return $_SESSION[$name] ?? GetUrl("eoqlist");
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
        if ($pageName == "eoqview") {
            return $Language->phrase("View");
        } elseif ($pageName == "eoqedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "eoqadd") {
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
                return "EoqView";
            case Config("API_ADD_ACTION"):
                return "EoqAdd";
            case Config("API_EDIT_ACTION"):
                return "EoqEdit";
            case Config("API_DELETE_ACTION"):
                return "EoqDelete";
            case Config("API_LIST_ACTION"):
                return "EoqList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "eoqlist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("eoqview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("eoqview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "eoqadd?" . $this->getUrlParm($parm);
        } else {
            $url = "eoqadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("eoqedit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("eoqadd", $this->getUrlParm($parm));
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
        return $this->keyUrl("eoqdelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
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
            //return $arKeys; // Do not return yet, so the values will also be checked by the following code
        }
        // Check keys
        $ar = [];
        if (is_array($arKeys)) {
            foreach ($arKeys as $key) {
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
        $this->nama_barang->setDbValue($row['nama_barang']);
        $this->harga_barang->setDbValue($row['harga_barang']);
        $this->konversi->setDbValue($row['konversi']);
        $this->D->setDbValue($row['D']);
        $this->pesan->setDbValue($row['pesan']);
        $this->H->setDbValue($row['H']);
        $this->C->setDbValue($row['C']);
        $this->R->setDbValue($row['R']);
        $this->EOQ->setDbValue($row['EOQ']);
        $this->kuantitas->setDbValue($row['kuantitas']);
        $this->pembelian_optimum->setDbValue($row['pembelian_optimum']);
        $this->daur_pembelian->setDbValue($row['daur_pembelian']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // nama_barang

        // harga_barang

        // konversi

        // D

        // pesan

        // H

        // C

        // R

        // EOQ

        // kuantitas

        // pembelian_optimum

        // daur_pembelian

        // nama_barang
        $this->nama_barang->ViewValue = $this->nama_barang->CurrentValue;
        $this->nama_barang->ViewCustomAttributes = "";

        // harga_barang
        $this->harga_barang->ViewValue = $this->harga_barang->CurrentValue;
        $this->harga_barang->ViewCustomAttributes = "";

        // konversi
        $this->konversi->ViewValue = $this->konversi->CurrentValue;
        $this->konversi->ViewCustomAttributes = "";

        // D
        $this->D->ViewValue = $this->D->CurrentValue;
        $this->D->ViewValue = FormatNumber($this->D->ViewValue, 2, -2, -2, -2);
        $this->D->ViewCustomAttributes = "";

        // pesan
        $this->pesan->ViewValue = $this->pesan->CurrentValue;
        $this->pesan->ViewValue = FormatNumber($this->pesan->ViewValue, 2, -2, -2, -2);
        $this->pesan->ViewCustomAttributes = "";

        // H
        $this->H->ViewValue = $this->H->CurrentValue;
        $this->H->ViewCustomAttributes = "";

        // C
        $this->C->ViewValue = $this->C->CurrentValue;
        $this->C->ViewValue = FormatNumber($this->C->ViewValue, 2, -2, -2, -2);
        $this->C->ViewCustomAttributes = "";

        // R
        $this->R->ViewValue = $this->R->CurrentValue;
        $this->R->ViewValue = FormatNumber($this->R->ViewValue, 2, -2, -2, -2);
        $this->R->ViewCustomAttributes = "";

        // EOQ
        $this->EOQ->ViewValue = $this->EOQ->CurrentValue;
        $this->EOQ->ViewValue = FormatNumber($this->EOQ->ViewValue, 2, -2, -2, -2);
        $this->EOQ->ViewCustomAttributes = "";

        // kuantitas
        $this->kuantitas->ViewValue = $this->kuantitas->CurrentValue;
        $this->kuantitas->ViewValue = FormatNumber($this->kuantitas->ViewValue, 2, -2, -2, -2);
        $this->kuantitas->ViewCustomAttributes = "";

        // pembelian_optimum
        $this->pembelian_optimum->ViewValue = $this->pembelian_optimum->CurrentValue;
        $this->pembelian_optimum->ViewValue = FormatNumber($this->pembelian_optimum->ViewValue, 2, -2, -2, -2);
        $this->pembelian_optimum->ViewCustomAttributes = "";

        // daur_pembelian
        $this->daur_pembelian->ViewValue = $this->daur_pembelian->CurrentValue;
        $this->daur_pembelian->ViewValue = FormatNumber($this->daur_pembelian->ViewValue, 2, -2, -2, -2);
        $this->daur_pembelian->ViewCustomAttributes = "";

        // nama_barang
        $this->nama_barang->LinkCustomAttributes = "";
        $this->nama_barang->HrefValue = "";
        $this->nama_barang->TooltipValue = "";

        // harga_barang
        $this->harga_barang->LinkCustomAttributes = "";
        $this->harga_barang->HrefValue = "";
        $this->harga_barang->TooltipValue = "";

        // konversi
        $this->konversi->LinkCustomAttributes = "";
        $this->konversi->HrefValue = "";
        $this->konversi->TooltipValue = "";

        // D
        $this->D->LinkCustomAttributes = "";
        $this->D->HrefValue = "";
        $this->D->TooltipValue = "";

        // pesan
        $this->pesan->LinkCustomAttributes = "";
        $this->pesan->HrefValue = "";
        $this->pesan->TooltipValue = "";

        // H
        $this->H->LinkCustomAttributes = "";
        $this->H->HrefValue = "";
        $this->H->TooltipValue = "";

        // C
        $this->C->LinkCustomAttributes = "";
        $this->C->HrefValue = "";
        $this->C->TooltipValue = "";

        // R
        $this->R->LinkCustomAttributes = "";
        $this->R->HrefValue = "";
        $this->R->TooltipValue = "";

        // EOQ
        $this->EOQ->LinkCustomAttributes = "";
        $this->EOQ->HrefValue = "";
        $this->EOQ->TooltipValue = "";

        // kuantitas
        $this->kuantitas->LinkCustomAttributes = "";
        $this->kuantitas->HrefValue = "";
        $this->kuantitas->TooltipValue = "";

        // pembelian_optimum
        $this->pembelian_optimum->LinkCustomAttributes = "";
        $this->pembelian_optimum->HrefValue = "";
        $this->pembelian_optimum->TooltipValue = "";

        // daur_pembelian
        $this->daur_pembelian->LinkCustomAttributes = "";
        $this->daur_pembelian->HrefValue = "";
        $this->daur_pembelian->TooltipValue = "";

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

        // konversi
        $this->konversi->EditAttrs["class"] = "form-control";
        $this->konversi->EditCustomAttributes = "";
        if (!$this->konversi->Raw) {
            $this->konversi->CurrentValue = HtmlDecode($this->konversi->CurrentValue);
        }
        $this->konversi->EditValue = $this->konversi->CurrentValue;
        $this->konversi->PlaceHolder = RemoveHtml($this->konversi->caption());

        // D
        $this->D->EditAttrs["class"] = "form-control";
        $this->D->EditCustomAttributes = "";
        $this->D->EditValue = $this->D->CurrentValue;
        $this->D->PlaceHolder = RemoveHtml($this->D->caption());
        if (strval($this->D->EditValue) != "" && is_numeric($this->D->EditValue)) {
            $this->D->EditValue = FormatNumber($this->D->EditValue, -2, -2, -2, -2);
        }

        // pesan
        $this->pesan->EditAttrs["class"] = "form-control";
        $this->pesan->EditCustomAttributes = "";
        $this->pesan->EditValue = $this->pesan->CurrentValue;
        $this->pesan->PlaceHolder = RemoveHtml($this->pesan->caption());
        if (strval($this->pesan->EditValue) != "" && is_numeric($this->pesan->EditValue)) {
            $this->pesan->EditValue = FormatNumber($this->pesan->EditValue, -2, -2, -2, -2);
        }

        // H
        $this->H->EditAttrs["class"] = "form-control";
        $this->H->EditCustomAttributes = "";
        if (!$this->H->Raw) {
            $this->H->CurrentValue = HtmlDecode($this->H->CurrentValue);
        }
        $this->H->EditValue = $this->H->CurrentValue;
        $this->H->PlaceHolder = RemoveHtml($this->H->caption());

        // C
        $this->C->EditAttrs["class"] = "form-control";
        $this->C->EditCustomAttributes = "";
        $this->C->EditValue = $this->C->CurrentValue;
        $this->C->PlaceHolder = RemoveHtml($this->C->caption());
        if (strval($this->C->EditValue) != "" && is_numeric($this->C->EditValue)) {
            $this->C->EditValue = FormatNumber($this->C->EditValue, -2, -2, -2, -2);
        }

        // R
        $this->R->EditAttrs["class"] = "form-control";
        $this->R->EditCustomAttributes = "";
        $this->R->EditValue = $this->R->CurrentValue;
        $this->R->PlaceHolder = RemoveHtml($this->R->caption());
        if (strval($this->R->EditValue) != "" && is_numeric($this->R->EditValue)) {
            $this->R->EditValue = FormatNumber($this->R->EditValue, -2, -2, -2, -2);
        }

        // EOQ
        $this->EOQ->EditAttrs["class"] = "form-control";
        $this->EOQ->EditCustomAttributes = "";
        $this->EOQ->EditValue = $this->EOQ->CurrentValue;
        $this->EOQ->PlaceHolder = RemoveHtml($this->EOQ->caption());
        if (strval($this->EOQ->EditValue) != "" && is_numeric($this->EOQ->EditValue)) {
            $this->EOQ->EditValue = FormatNumber($this->EOQ->EditValue, -2, -2, -2, -2);
        }

        // kuantitas
        $this->kuantitas->EditAttrs["class"] = "form-control";
        $this->kuantitas->EditCustomAttributes = "";
        $this->kuantitas->EditValue = $this->kuantitas->CurrentValue;
        $this->kuantitas->PlaceHolder = RemoveHtml($this->kuantitas->caption());
        if (strval($this->kuantitas->EditValue) != "" && is_numeric($this->kuantitas->EditValue)) {
            $this->kuantitas->EditValue = FormatNumber($this->kuantitas->EditValue, -2, -2, -2, -2);
        }

        // pembelian_optimum
        $this->pembelian_optimum->EditAttrs["class"] = "form-control";
        $this->pembelian_optimum->EditCustomAttributes = "";
        $this->pembelian_optimum->EditValue = $this->pembelian_optimum->CurrentValue;
        $this->pembelian_optimum->PlaceHolder = RemoveHtml($this->pembelian_optimum->caption());
        if (strval($this->pembelian_optimum->EditValue) != "" && is_numeric($this->pembelian_optimum->EditValue)) {
            $this->pembelian_optimum->EditValue = FormatNumber($this->pembelian_optimum->EditValue, -2, -2, -2, -2);
        }

        // daur_pembelian
        $this->daur_pembelian->EditAttrs["class"] = "form-control";
        $this->daur_pembelian->EditCustomAttributes = "";
        $this->daur_pembelian->EditValue = $this->daur_pembelian->CurrentValue;
        $this->daur_pembelian->PlaceHolder = RemoveHtml($this->daur_pembelian->caption());
        if (strval($this->daur_pembelian->EditValue) != "" && is_numeric($this->daur_pembelian->EditValue)) {
            $this->daur_pembelian->EditValue = FormatNumber($this->daur_pembelian->EditValue, -2, -2, -2, -2);
        }

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
                    $doc->exportCaption($this->nama_barang);
                    $doc->exportCaption($this->harga_barang);
                    $doc->exportCaption($this->konversi);
                    $doc->exportCaption($this->D);
                    $doc->exportCaption($this->pesan);
                    $doc->exportCaption($this->H);
                    $doc->exportCaption($this->C);
                    $doc->exportCaption($this->R);
                    $doc->exportCaption($this->EOQ);
                    $doc->exportCaption($this->kuantitas);
                    $doc->exportCaption($this->pembelian_optimum);
                    $doc->exportCaption($this->daur_pembelian);
                } else {
                    $doc->exportCaption($this->nama_barang);
                    $doc->exportCaption($this->harga_barang);
                    $doc->exportCaption($this->konversi);
                    $doc->exportCaption($this->D);
                    $doc->exportCaption($this->pesan);
                    $doc->exportCaption($this->H);
                    $doc->exportCaption($this->C);
                    $doc->exportCaption($this->R);
                    $doc->exportCaption($this->EOQ);
                    $doc->exportCaption($this->kuantitas);
                    $doc->exportCaption($this->pembelian_optimum);
                    $doc->exportCaption($this->daur_pembelian);
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
                        $doc->exportField($this->nama_barang);
                        $doc->exportField($this->harga_barang);
                        $doc->exportField($this->konversi);
                        $doc->exportField($this->D);
                        $doc->exportField($this->pesan);
                        $doc->exportField($this->H);
                        $doc->exportField($this->C);
                        $doc->exportField($this->R);
                        $doc->exportField($this->EOQ);
                        $doc->exportField($this->kuantitas);
                        $doc->exportField($this->pembelian_optimum);
                        $doc->exportField($this->daur_pembelian);
                    } else {
                        $doc->exportField($this->nama_barang);
                        $doc->exportField($this->harga_barang);
                        $doc->exportField($this->konversi);
                        $doc->exportField($this->D);
                        $doc->exportField($this->pesan);
                        $doc->exportField($this->H);
                        $doc->exportField($this->C);
                        $doc->exportField($this->R);
                        $doc->exportField($this->EOQ);
                        $doc->exportField($this->kuantitas);
                        $doc->exportField($this->pembelian_optimum);
                        $doc->exportField($this->daur_pembelian);
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
