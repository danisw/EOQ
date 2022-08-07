<?php

namespace PHPMaker2021\eoq;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for rop
 */
class Rop extends DbTable
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
    public $satuan;
    public $konversi;
    public $lead_time;
    public $pesanan_total;
    public $total_barang;
    public $X;
    public $Y;
    public $XY;
    public $XY2;
    public $sigma;
    public $safety_stock;
    public $LQ;
    public $ROP;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'rop';
        $this->TableName = 'rop';
        $this->TableType = 'VIEW';

        // Update Table
        $this->UpdateTable = "`rop`";
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
        $this->nama_barang = new DbField('rop', 'rop', 'x_nama_barang', 'nama_barang', '`nama_barang`', '`nama_barang`', 200, 64, -1, false, '`nama_barang`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->nama_barang->Nullable = false; // NOT NULL field
        $this->nama_barang->Required = true; // Required field
        $this->nama_barang->Sortable = true; // Allow sort
        $this->nama_barang->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nama_barang->Param, "CustomMsg");
        $this->Fields['nama_barang'] = &$this->nama_barang;

        // harga_barang
        $this->harga_barang = new DbField('rop', 'rop', 'x_harga_barang', 'harga_barang', '`harga_barang`', '`harga_barang`', 200, 16, -1, false, '`harga_barang`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->harga_barang->Nullable = false; // NOT NULL field
        $this->harga_barang->Required = true; // Required field
        $this->harga_barang->Sortable = true; // Allow sort
        $this->harga_barang->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->harga_barang->Param, "CustomMsg");
        $this->Fields['harga_barang'] = &$this->harga_barang;

        // satuan
        $this->satuan = new DbField('rop', 'rop', 'x_satuan', 'satuan', '`satuan`', '`satuan`', 200, 16, -1, false, '`satuan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->satuan->Nullable = false; // NOT NULL field
        $this->satuan->Required = true; // Required field
        $this->satuan->Sortable = true; // Allow sort
        $this->satuan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->satuan->Param, "CustomMsg");
        $this->Fields['satuan'] = &$this->satuan;

        // konversi
        $this->konversi = new DbField('rop', 'rop', 'x_konversi', 'konversi', '`konversi`', '`konversi`', 200, 16, -1, false, '`konversi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->konversi->Nullable = false; // NOT NULL field
        $this->konversi->Required = true; // Required field
        $this->konversi->Sortable = true; // Allow sort
        $this->konversi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->konversi->Param, "CustomMsg");
        $this->Fields['konversi'] = &$this->konversi;

        // lead_time
        $this->lead_time = new DbField('rop', 'rop', 'x_lead_time', 'lead_time', '`lead_time`', '`lead_time`', 3, 4, -1, false, '`lead_time`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->lead_time->Nullable = false; // NOT NULL field
        $this->lead_time->Required = true; // Required field
        $this->lead_time->Sortable = true; // Allow sort
        $this->lead_time->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->lead_time->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->lead_time->Param, "CustomMsg");
        $this->Fields['lead_time'] = &$this->lead_time;

        // pesanan_total
        $this->pesanan_total = new DbField('rop', 'rop', 'x_pesanan_total', 'pesanan_total', '`pesanan_total`', '`pesanan_total`', 5, 23, -1, false, '`pesanan_total`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pesanan_total->Sortable = true; // Allow sort
        $this->pesanan_total->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->pesanan_total->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->pesanan_total->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pesanan_total->Param, "CustomMsg");
        $this->Fields['pesanan_total'] = &$this->pesanan_total;

        // total_barang
        $this->total_barang = new DbField('rop', 'rop', 'x_total_barang', 'total_barang', '`total_barang`', '`total_barang`', 5, 23, -1, false, '`total_barang`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->total_barang->Sortable = true; // Allow sort
        $this->total_barang->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->total_barang->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->total_barang->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->total_barang->Param, "CustomMsg");
        $this->Fields['total_barang'] = &$this->total_barang;

        // X
        $this->X = new DbField('rop', 'rop', 'x_X', 'X', '`X`', '`X`', 5, 23, -1, false, '`X`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->X->Sortable = true; // Allow sort
        $this->X->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->X->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->X->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->X->Param, "CustomMsg");
        $this->Fields['X'] = &$this->X;

        // Y
        $this->Y = new DbField('rop', 'rop', 'x_Y', 'Y', '`Y`', '`Y`', 5, 23, -1, false, '`Y`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Y->Sortable = true; // Allow sort
        $this->Y->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Y->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Y->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Y->Param, "CustomMsg");
        $this->Fields['Y'] = &$this->Y;

        // X-Y
        $this->XY = new DbField('rop', 'rop', 'x_XY', 'X-Y', '`X-Y`', '`X-Y`', 5, 23, -1, false, '`X-Y`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->XY->Sortable = true; // Allow sort
        $this->XY->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->XY->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->XY->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->XY->Param, "CustomMsg");
        $this->Fields['X-Y'] = &$this->XY;

        // X-Y^2
        $this->XY2 = new DbField('rop', 'rop', 'x_XY2', 'X-Y^2', '`X-Y^2`', '`X-Y^2`', 5, 23, -1, false, '`X-Y^2`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->XY2->Sortable = true; // Allow sort
        $this->XY2->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->XY2->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->XY2->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->XY2->Param, "CustomMsg");
        $this->Fields['X-Y^2'] = &$this->XY2;

        // sigma
        $this->sigma = new DbField('rop', 'rop', 'x_sigma', 'sigma', '`sigma`', '`sigma`', 5, 20, -1, false, '`sigma`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->sigma->Sortable = true; // Allow sort
        $this->sigma->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->sigma->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->sigma->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->sigma->Param, "CustomMsg");
        $this->Fields['sigma'] = &$this->sigma;

        // safety_stock
        $this->safety_stock = new DbField('rop', 'rop', 'x_safety_stock', 'safety_stock', '`safety_stock`', '`safety_stock`', 5, 20, -1, false, '`safety_stock`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->safety_stock->Sortable = true; // Allow sort
        $this->safety_stock->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->safety_stock->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->safety_stock->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->safety_stock->Param, "CustomMsg");
        $this->Fields['safety_stock'] = &$this->safety_stock;

        // LQ
        $this->LQ = new DbField('rop', 'rop', 'x_LQ', 'LQ', '`LQ`', '`LQ`', 5, 20, -1, false, '`LQ`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->LQ->Sortable = true; // Allow sort
        $this->LQ->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->LQ->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->LQ->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->LQ->Param, "CustomMsg");
        $this->Fields['LQ'] = &$this->LQ;

        // ROP
        $this->ROP = new DbField('rop', 'rop', 'x_ROP', 'ROP', '`ROP`', '`ROP`', 5, 20, -1, false, '`ROP`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ROP->Sortable = true; // Allow sort
        $this->ROP->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->ROP->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->ROP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ROP->Param, "CustomMsg");
        $this->Fields['ROP'] = &$this->ROP;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`rop`";
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
        $this->satuan->DbValue = $row['satuan'];
        $this->konversi->DbValue = $row['konversi'];
        $this->lead_time->DbValue = $row['lead_time'];
        $this->pesanan_total->DbValue = $row['pesanan_total'];
        $this->total_barang->DbValue = $row['total_barang'];
        $this->X->DbValue = $row['X'];
        $this->Y->DbValue = $row['Y'];
        $this->XY->DbValue = $row['X-Y'];
        $this->XY2->DbValue = $row['X-Y^2'];
        $this->sigma->DbValue = $row['sigma'];
        $this->safety_stock->DbValue = $row['safety_stock'];
        $this->LQ->DbValue = $row['LQ'];
        $this->ROP->DbValue = $row['ROP'];
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
        return $_SESSION[$name] ?? GetUrl("roplist");
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
        if ($pageName == "ropview") {
            return $Language->phrase("View");
        } elseif ($pageName == "ropedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "ropadd") {
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
                return "RopView";
            case Config("API_ADD_ACTION"):
                return "RopAdd";
            case Config("API_EDIT_ACTION"):
                return "RopEdit";
            case Config("API_DELETE_ACTION"):
                return "RopDelete";
            case Config("API_LIST_ACTION"):
                return "RopList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "roplist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("ropview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("ropview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "ropadd?" . $this->getUrlParm($parm);
        } else {
            $url = "ropadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("ropedit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("ropadd", $this->getUrlParm($parm));
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
        return $this->keyUrl("ropdelete", $this->getUrlParm());
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
        $this->satuan->setDbValue($row['satuan']);
        $this->konversi->setDbValue($row['konversi']);
        $this->lead_time->setDbValue($row['lead_time']);
        $this->pesanan_total->setDbValue($row['pesanan_total']);
        $this->total_barang->setDbValue($row['total_barang']);
        $this->X->setDbValue($row['X']);
        $this->Y->setDbValue($row['Y']);
        $this->XY->setDbValue($row['X-Y']);
        $this->XY2->setDbValue($row['X-Y^2']);
        $this->sigma->setDbValue($row['sigma']);
        $this->safety_stock->setDbValue($row['safety_stock']);
        $this->LQ->setDbValue($row['LQ']);
        $this->ROP->setDbValue($row['ROP']);
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

        // satuan

        // konversi

        // lead_time

        // pesanan_total

        // total_barang

        // X

        // Y

        // X-Y

        // X-Y^2

        // sigma

        // safety_stock

        // LQ

        // ROP

        // nama_barang
        $this->nama_barang->ViewValue = $this->nama_barang->CurrentValue;
        $this->nama_barang->ViewCustomAttributes = "";

        // harga_barang
        $this->harga_barang->ViewValue = $this->harga_barang->CurrentValue;
        $this->harga_barang->ViewCustomAttributes = "";

        // satuan
        $this->satuan->ViewValue = $this->satuan->CurrentValue;
        $this->satuan->ViewCustomAttributes = "";

        // konversi
        $this->konversi->ViewValue = $this->konversi->CurrentValue;
        $this->konversi->ViewCustomAttributes = "";

        // lead_time
        $this->lead_time->ViewValue = $this->lead_time->CurrentValue;
        $this->lead_time->ViewValue = FormatNumber($this->lead_time->ViewValue, 0, -2, -2, -2);
        $this->lead_time->ViewCustomAttributes = "";

        // pesanan_total
        $this->pesanan_total->ViewValue = $this->pesanan_total->CurrentValue;
        $this->pesanan_total->ViewValue = FormatNumber($this->pesanan_total->ViewValue, 2, -2, -2, -2);
        $this->pesanan_total->ViewCustomAttributes = "";

        // total_barang
        $this->total_barang->ViewValue = $this->total_barang->CurrentValue;
        $this->total_barang->ViewValue = FormatNumber($this->total_barang->ViewValue, 2, -2, -2, -2);
        $this->total_barang->ViewCustomAttributes = "";

        // X
        $this->X->ViewValue = $this->X->CurrentValue;
        $this->X->ViewValue = FormatNumber($this->X->ViewValue, 2, -2, -2, -2);
        $this->X->ViewCustomAttributes = "";

        // Y
        $this->Y->ViewValue = $this->Y->CurrentValue;
        $this->Y->ViewValue = FormatNumber($this->Y->ViewValue, 2, -2, -2, -2);
        $this->Y->ViewCustomAttributes = "";

        // X-Y
        $this->XY->ViewValue = $this->XY->CurrentValue;
        $this->XY->ViewValue = FormatNumber($this->XY->ViewValue, 2, -2, -2, -2);
        $this->XY->ViewCustomAttributes = "";

        // X-Y^2
        $this->XY2->ViewValue = $this->XY2->CurrentValue;
        $this->XY2->ViewValue = FormatNumber($this->XY2->ViewValue, 2, -2, -2, -2);
        $this->XY2->ViewCustomAttributes = "";

        // sigma
        $this->sigma->ViewValue = $this->sigma->CurrentValue;
        $this->sigma->ViewValue = FormatNumber($this->sigma->ViewValue, 2, -2, -2, -2);
        $this->sigma->ViewCustomAttributes = "";

        // safety_stock
        $this->safety_stock->ViewValue = $this->safety_stock->CurrentValue;
        $this->safety_stock->ViewValue = FormatNumber($this->safety_stock->ViewValue, 2, -2, -2, -2);
        $this->safety_stock->ViewCustomAttributes = "";

        // LQ
        $this->LQ->ViewValue = $this->LQ->CurrentValue;
        $this->LQ->ViewValue = FormatNumber($this->LQ->ViewValue, 2, -2, -2, -2);
        $this->LQ->ViewCustomAttributes = "";

        // ROP
        $this->ROP->ViewValue = $this->ROP->CurrentValue;
        $this->ROP->ViewValue = FormatNumber($this->ROP->ViewValue, 2, -2, -2, -2);
        $this->ROP->ViewCustomAttributes = "";

        // nama_barang
        $this->nama_barang->LinkCustomAttributes = "";
        $this->nama_barang->HrefValue = "";
        $this->nama_barang->TooltipValue = "";

        // harga_barang
        $this->harga_barang->LinkCustomAttributes = "";
        $this->harga_barang->HrefValue = "";
        $this->harga_barang->TooltipValue = "";

        // satuan
        $this->satuan->LinkCustomAttributes = "";
        $this->satuan->HrefValue = "";
        $this->satuan->TooltipValue = "";

        // konversi
        $this->konversi->LinkCustomAttributes = "";
        $this->konversi->HrefValue = "";
        $this->konversi->TooltipValue = "";

        // lead_time
        $this->lead_time->LinkCustomAttributes = "";
        $this->lead_time->HrefValue = "";
        $this->lead_time->TooltipValue = "";

        // pesanan_total
        $this->pesanan_total->LinkCustomAttributes = "";
        $this->pesanan_total->HrefValue = "";
        $this->pesanan_total->TooltipValue = "";

        // total_barang
        $this->total_barang->LinkCustomAttributes = "";
        $this->total_barang->HrefValue = "";
        $this->total_barang->TooltipValue = "";

        // X
        $this->X->LinkCustomAttributes = "";
        $this->X->HrefValue = "";
        $this->X->TooltipValue = "";

        // Y
        $this->Y->LinkCustomAttributes = "";
        $this->Y->HrefValue = "";
        $this->Y->TooltipValue = "";

        // X-Y
        $this->XY->LinkCustomAttributes = "";
        $this->XY->HrefValue = "";
        $this->XY->TooltipValue = "";

        // X-Y^2
        $this->XY2->LinkCustomAttributes = "";
        $this->XY2->HrefValue = "";
        $this->XY2->TooltipValue = "";

        // sigma
        $this->sigma->LinkCustomAttributes = "";
        $this->sigma->HrefValue = "";
        $this->sigma->TooltipValue = "";

        // safety_stock
        $this->safety_stock->LinkCustomAttributes = "";
        $this->safety_stock->HrefValue = "";
        $this->safety_stock->TooltipValue = "";

        // LQ
        $this->LQ->LinkCustomAttributes = "";
        $this->LQ->HrefValue = "";
        $this->LQ->TooltipValue = "";

        // ROP
        $this->ROP->LinkCustomAttributes = "";
        $this->ROP->HrefValue = "";
        $this->ROP->TooltipValue = "";

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

        // lead_time
        $this->lead_time->EditAttrs["class"] = "form-control";
        $this->lead_time->EditCustomAttributes = "";
        $this->lead_time->EditValue = $this->lead_time->CurrentValue;
        $this->lead_time->PlaceHolder = RemoveHtml($this->lead_time->caption());

        // pesanan_total
        $this->pesanan_total->EditAttrs["class"] = "form-control";
        $this->pesanan_total->EditCustomAttributes = "";
        $this->pesanan_total->EditValue = $this->pesanan_total->CurrentValue;
        $this->pesanan_total->PlaceHolder = RemoveHtml($this->pesanan_total->caption());
        if (strval($this->pesanan_total->EditValue) != "" && is_numeric($this->pesanan_total->EditValue)) {
            $this->pesanan_total->EditValue = FormatNumber($this->pesanan_total->EditValue, -2, -2, -2, -2);
        }

        // total_barang
        $this->total_barang->EditAttrs["class"] = "form-control";
        $this->total_barang->EditCustomAttributes = "";
        $this->total_barang->EditValue = $this->total_barang->CurrentValue;
        $this->total_barang->PlaceHolder = RemoveHtml($this->total_barang->caption());
        if (strval($this->total_barang->EditValue) != "" && is_numeric($this->total_barang->EditValue)) {
            $this->total_barang->EditValue = FormatNumber($this->total_barang->EditValue, -2, -2, -2, -2);
        }

        // X
        $this->X->EditAttrs["class"] = "form-control";
        $this->X->EditCustomAttributes = "";
        $this->X->EditValue = $this->X->CurrentValue;
        $this->X->PlaceHolder = RemoveHtml($this->X->caption());
        if (strval($this->X->EditValue) != "" && is_numeric($this->X->EditValue)) {
            $this->X->EditValue = FormatNumber($this->X->EditValue, -2, -2, -2, -2);
        }

        // Y
        $this->Y->EditAttrs["class"] = "form-control";
        $this->Y->EditCustomAttributes = "";
        $this->Y->EditValue = $this->Y->CurrentValue;
        $this->Y->PlaceHolder = RemoveHtml($this->Y->caption());
        if (strval($this->Y->EditValue) != "" && is_numeric($this->Y->EditValue)) {
            $this->Y->EditValue = FormatNumber($this->Y->EditValue, -2, -2, -2, -2);
        }

        // X-Y
        $this->XY->EditAttrs["class"] = "form-control";
        $this->XY->EditCustomAttributes = "";
        $this->XY->EditValue = $this->XY->CurrentValue;
        $this->XY->PlaceHolder = RemoveHtml($this->XY->caption());
        if (strval($this->XY->EditValue) != "" && is_numeric($this->XY->EditValue)) {
            $this->XY->EditValue = FormatNumber($this->XY->EditValue, -2, -2, -2, -2);
        }

        // X-Y^2
        $this->XY2->EditAttrs["class"] = "form-control";
        $this->XY2->EditCustomAttributes = "";
        $this->XY2->EditValue = $this->XY2->CurrentValue;
        $this->XY2->PlaceHolder = RemoveHtml($this->XY2->caption());
        if (strval($this->XY2->EditValue) != "" && is_numeric($this->XY2->EditValue)) {
            $this->XY2->EditValue = FormatNumber($this->XY2->EditValue, -2, -2, -2, -2);
        }

        // sigma
        $this->sigma->EditAttrs["class"] = "form-control";
        $this->sigma->EditCustomAttributes = "";
        $this->sigma->EditValue = $this->sigma->CurrentValue;
        $this->sigma->PlaceHolder = RemoveHtml($this->sigma->caption());
        if (strval($this->sigma->EditValue) != "" && is_numeric($this->sigma->EditValue)) {
            $this->sigma->EditValue = FormatNumber($this->sigma->EditValue, -2, -2, -2, -2);
        }

        // safety_stock
        $this->safety_stock->EditAttrs["class"] = "form-control";
        $this->safety_stock->EditCustomAttributes = "";
        $this->safety_stock->EditValue = $this->safety_stock->CurrentValue;
        $this->safety_stock->PlaceHolder = RemoveHtml($this->safety_stock->caption());
        if (strval($this->safety_stock->EditValue) != "" && is_numeric($this->safety_stock->EditValue)) {
            $this->safety_stock->EditValue = FormatNumber($this->safety_stock->EditValue, -2, -2, -2, -2);
        }

        // LQ
        $this->LQ->EditAttrs["class"] = "form-control";
        $this->LQ->EditCustomAttributes = "";
        $this->LQ->EditValue = $this->LQ->CurrentValue;
        $this->LQ->PlaceHolder = RemoveHtml($this->LQ->caption());
        if (strval($this->LQ->EditValue) != "" && is_numeric($this->LQ->EditValue)) {
            $this->LQ->EditValue = FormatNumber($this->LQ->EditValue, -2, -2, -2, -2);
        }

        // ROP
        $this->ROP->EditAttrs["class"] = "form-control";
        $this->ROP->EditCustomAttributes = "";
        $this->ROP->EditValue = $this->ROP->CurrentValue;
        $this->ROP->PlaceHolder = RemoveHtml($this->ROP->caption());
        if (strval($this->ROP->EditValue) != "" && is_numeric($this->ROP->EditValue)) {
            $this->ROP->EditValue = FormatNumber($this->ROP->EditValue, -2, -2, -2, -2);
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
                    $doc->exportCaption($this->satuan);
                    $doc->exportCaption($this->konversi);
                    $doc->exportCaption($this->lead_time);
                    $doc->exportCaption($this->pesanan_total);
                    $doc->exportCaption($this->total_barang);
                    $doc->exportCaption($this->X);
                    $doc->exportCaption($this->Y);
                    $doc->exportCaption($this->XY);
                    $doc->exportCaption($this->XY2);
                    $doc->exportCaption($this->sigma);
                    $doc->exportCaption($this->safety_stock);
                    $doc->exportCaption($this->LQ);
                    $doc->exportCaption($this->ROP);
                } else {
                    $doc->exportCaption($this->nama_barang);
                    $doc->exportCaption($this->harga_barang);
                    $doc->exportCaption($this->satuan);
                    $doc->exportCaption($this->konversi);
                    $doc->exportCaption($this->lead_time);
                    $doc->exportCaption($this->pesanan_total);
                    $doc->exportCaption($this->total_barang);
                    $doc->exportCaption($this->X);
                    $doc->exportCaption($this->Y);
                    $doc->exportCaption($this->XY);
                    $doc->exportCaption($this->XY2);
                    $doc->exportCaption($this->sigma);
                    $doc->exportCaption($this->safety_stock);
                    $doc->exportCaption($this->LQ);
                    $doc->exportCaption($this->ROP);
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
                        $doc->exportField($this->satuan);
                        $doc->exportField($this->konversi);
                        $doc->exportField($this->lead_time);
                        $doc->exportField($this->pesanan_total);
                        $doc->exportField($this->total_barang);
                        $doc->exportField($this->X);
                        $doc->exportField($this->Y);
                        $doc->exportField($this->XY);
                        $doc->exportField($this->XY2);
                        $doc->exportField($this->sigma);
                        $doc->exportField($this->safety_stock);
                        $doc->exportField($this->LQ);
                        $doc->exportField($this->ROP);
                    } else {
                        $doc->exportField($this->nama_barang);
                        $doc->exportField($this->harga_barang);
                        $doc->exportField($this->satuan);
                        $doc->exportField($this->konversi);
                        $doc->exportField($this->lead_time);
                        $doc->exportField($this->pesanan_total);
                        $doc->exportField($this->total_barang);
                        $doc->exportField($this->X);
                        $doc->exportField($this->Y);
                        $doc->exportField($this->XY);
                        $doc->exportField($this->XY2);
                        $doc->exportField($this->sigma);
                        $doc->exportField($this->safety_stock);
                        $doc->exportField($this->LQ);
                        $doc->exportField($this->ROP);
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
