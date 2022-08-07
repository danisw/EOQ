<?php

namespace PHPMaker2021\eoq;

// Page object
$EoqList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var feoqlist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    feoqlist = currentForm = new ew.Form("feoqlist", "list");
    feoqlist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("feoqlist");
});
var feoqlistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    feoqlistsrch = currentSearchForm = new ew.Form("feoqlistsrch");

    // Dynamic selection lists

    // Filters
    feoqlistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("feoqlistsrch");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($Page->TotalRecords > 0 && $Page->ExportOptions->visible()) { ?>
<?php $Page->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->ImportOptions->visible()) { ?>
<?php $Page->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->SearchOptions->visible()) { ?>
<?php $Page->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($Page->FilterOptions->visible()) { ?>
<?php $Page->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$Page->renderOtherOptions();
?>
<?php if ($Security->canSearch()) { ?>
<?php if (!$Page->isExport() && !$Page->CurrentAction) { ?>
<form name="feoqlistsrch" id="feoqlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="feoqlistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="eoq">
    <div class="ew-extended-search">
<div id="xsr_<?= $Page->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
    <div class="ew-quick-search input-group">
        <input type="text" name="<?= Config("TABLE_BASIC_SEARCH") ?>" id="<?= Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?= HtmlEncode($Page->BasicSearch->getKeyword()) ?>" placeholder="<?= HtmlEncode($Language->phrase("Search")) ?>">
        <input type="hidden" name="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?= HtmlEncode($Page->BasicSearch->getType()) ?>">
        <div class="input-group-append">
            <button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?= $Language->phrase("SearchBtn") ?></button>
            <button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?= $Page->BasicSearch->getTypeNameShort() ?></span></button>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item<?php if ($Page->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?= $Language->phrase("QuickSearchAuto") ?></a>
                <a class="dropdown-item<?php if ($Page->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?= $Language->phrase("QuickSearchExact") ?></a>
                <a class="dropdown-item<?php if ($Page->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?= $Language->phrase("QuickSearchAll") ?></a>
                <a class="dropdown-item<?php if ($Page->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?= $Language->phrase("QuickSearchAny") ?></a>
            </div>
        </div>
    </div>
</div>
    </div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> eoq">
<form name="feoqlist" id="feoqlist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="eoq">
<div id="gmp_eoq" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_eoqlist" class="table ew-table"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Page->RowType = ROWTYPE_HEADER;

// Render list options
$Page->renderListOptions();

// Render list options (header, left)
$Page->ListOptions->render("header", "left");
?>
<?php if ($Page->nama_barang->Visible) { // nama_barang ?>
        <th data-name="nama_barang" class="<?= $Page->nama_barang->headerCellClass() ?>"><div id="elh_eoq_nama_barang" class="eoq_nama_barang"><?= $Page->renderSort($Page->nama_barang) ?></div></th>
<?php } ?>
<?php if ($Page->harga_barang->Visible) { // harga_barang ?>
        <th data-name="harga_barang" class="<?= $Page->harga_barang->headerCellClass() ?>"><div id="elh_eoq_harga_barang" class="eoq_harga_barang"><?= $Page->renderSort($Page->harga_barang) ?></div></th>
<?php } ?>
<?php if ($Page->konversi->Visible) { // konversi ?>
        <th data-name="konversi" class="<?= $Page->konversi->headerCellClass() ?>"><div id="elh_eoq_konversi" class="eoq_konversi"><?= $Page->renderSort($Page->konversi) ?></div></th>
<?php } ?>
<?php if ($Page->D->Visible) { // D ?>
        <th data-name="D" class="<?= $Page->D->headerCellClass() ?>"><div id="elh_eoq_D" class="eoq_D"><?= $Page->renderSort($Page->D) ?></div></th>
<?php } ?>
<?php if ($Page->pesan->Visible) { // pesan ?>
        <th data-name="pesan" class="<?= $Page->pesan->headerCellClass() ?>"><div id="elh_eoq_pesan" class="eoq_pesan"><?= $Page->renderSort($Page->pesan) ?></div></th>
<?php } ?>
<?php if ($Page->H->Visible) { // H ?>
        <th data-name="H" class="<?= $Page->H->headerCellClass() ?>"><div id="elh_eoq_H" class="eoq_H"><?= $Page->renderSort($Page->H) ?></div></th>
<?php } ?>
<?php if ($Page->C->Visible) { // C ?>
        <th data-name="C" class="<?= $Page->C->headerCellClass() ?>"><div id="elh_eoq_C" class="eoq_C"><?= $Page->renderSort($Page->C) ?></div></th>
<?php } ?>
<?php if ($Page->R->Visible) { // R ?>
        <th data-name="R" class="<?= $Page->R->headerCellClass() ?>"><div id="elh_eoq_R" class="eoq_R"><?= $Page->renderSort($Page->R) ?></div></th>
<?php } ?>
<?php if ($Page->EOQ->Visible) { // EOQ ?>
        <th data-name="EOQ" class="<?= $Page->EOQ->headerCellClass() ?>"><div id="elh_eoq_EOQ" class="eoq_EOQ"><?= $Page->renderSort($Page->EOQ) ?></div></th>
<?php } ?>
<?php if ($Page->kuantitas->Visible) { // kuantitas ?>
        <th data-name="kuantitas" class="<?= $Page->kuantitas->headerCellClass() ?>"><div id="elh_eoq_kuantitas" class="eoq_kuantitas"><?= $Page->renderSort($Page->kuantitas) ?></div></th>
<?php } ?>
<?php if ($Page->pembelian_optimum->Visible) { // pembelian_optimum ?>
        <th data-name="pembelian_optimum" class="<?= $Page->pembelian_optimum->headerCellClass() ?>"><div id="elh_eoq_pembelian_optimum" class="eoq_pembelian_optimum"><?= $Page->renderSort($Page->pembelian_optimum) ?></div></th>
<?php } ?>
<?php if ($Page->daur_pembelian->Visible) { // daur_pembelian ?>
        <th data-name="daur_pembelian" class="<?= $Page->daur_pembelian->headerCellClass() ?>"><div id="elh_eoq_daur_pembelian" class="eoq_daur_pembelian"><?= $Page->renderSort($Page->daur_pembelian) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Page->ListOptions->render("header", "right");
?>
    </tr>
</thead>
<tbody>
<?php
if ($Page->ExportAll && $Page->isExport()) {
    $Page->StopRecord = $Page->TotalRecords;
} else {
    // Set the last record to display
    if ($Page->TotalRecords > $Page->StartRecord + $Page->DisplayRecords - 1) {
        $Page->StopRecord = $Page->StartRecord + $Page->DisplayRecords - 1;
    } else {
        $Page->StopRecord = $Page->TotalRecords;
    }
}
$Page->RecordCount = $Page->StartRecord - 1;
if ($Page->Recordset && !$Page->Recordset->EOF) {
    // Nothing to do
} elseif (!$Page->AllowAddDeleteRow && $Page->StopRecord == 0) {
    $Page->StopRecord = $Page->GridAddRowCount;
}

// Initialize aggregate
$Page->RowType = ROWTYPE_AGGREGATEINIT;
$Page->resetAttributes();
$Page->renderRow();
while ($Page->RecordCount < $Page->StopRecord) {
    $Page->RecordCount++;
    if ($Page->RecordCount >= $Page->StartRecord) {
        $Page->RowCount++;

        // Set up key count
        $Page->KeyCount = $Page->RowIndex;

        // Init row class and style
        $Page->resetAttributes();
        $Page->CssClass = "";
        if ($Page->isGridAdd()) {
            $Page->loadRowValues(); // Load default values
            $Page->OldKey = "";
            $Page->setKey($Page->OldKey);
        } else {
            $Page->loadRowValues($Page->Recordset); // Load row values
            if ($Page->isGridEdit()) {
                $Page->OldKey = $Page->getKey(true); // Get from CurrentValue
                $Page->setKey($Page->OldKey);
            }
        }
        $Page->RowType = ROWTYPE_VIEW; // Render view

        // Set up row id / data-rowindex
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_eoq", "data-rowtype" => $Page->RowType]);

        // Render row
        $Page->renderRow();

        // Render list options
        $Page->renderListOptions();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Page->ListOptions->render("body", "left", $Page->RowCount);
?>
    <?php if ($Page->nama_barang->Visible) { // nama_barang ?>
        <td data-name="nama_barang" <?= $Page->nama_barang->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_eoq_nama_barang">
<span<?= $Page->nama_barang->viewAttributes() ?>>
<?= $Page->nama_barang->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->harga_barang->Visible) { // harga_barang ?>
        <td data-name="harga_barang" <?= $Page->harga_barang->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_eoq_harga_barang">
<span<?= $Page->harga_barang->viewAttributes() ?>>
<?= $Page->harga_barang->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->konversi->Visible) { // konversi ?>
        <td data-name="konversi" <?= $Page->konversi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_eoq_konversi">
<span<?= $Page->konversi->viewAttributes() ?>>
<?= $Page->konversi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->D->Visible) { // D ?>
        <td data-name="D" <?= $Page->D->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_eoq_D">
<span<?= $Page->D->viewAttributes() ?>>
<?= $Page->D->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->pesan->Visible) { // pesan ?>
        <td data-name="pesan" <?= $Page->pesan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_eoq_pesan">
<span<?= $Page->pesan->viewAttributes() ?>>
<?= $Page->pesan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->H->Visible) { // H ?>
        <td data-name="H" <?= $Page->H->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_eoq_H">
<span<?= $Page->H->viewAttributes() ?>>
<?= $Page->H->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->C->Visible) { // C ?>
        <td data-name="C" <?= $Page->C->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_eoq_C">
<span<?= $Page->C->viewAttributes() ?>>
<?= $Page->C->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->R->Visible) { // R ?>
        <td data-name="R" <?= $Page->R->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_eoq_R">
<span<?= $Page->R->viewAttributes() ?>>
<?= $Page->R->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->EOQ->Visible) { // EOQ ?>
        <td data-name="EOQ" <?= $Page->EOQ->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_eoq_EOQ">
<span<?= $Page->EOQ->viewAttributes() ?>>
<?= $Page->EOQ->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kuantitas->Visible) { // kuantitas ?>
        <td data-name="kuantitas" <?= $Page->kuantitas->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_eoq_kuantitas">
<span<?= $Page->kuantitas->viewAttributes() ?>>
<?= $Page->kuantitas->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->pembelian_optimum->Visible) { // pembelian_optimum ?>
        <td data-name="pembelian_optimum" <?= $Page->pembelian_optimum->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_eoq_pembelian_optimum">
<span<?= $Page->pembelian_optimum->viewAttributes() ?>>
<?= $Page->pembelian_optimum->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->daur_pembelian->Visible) { // daur_pembelian ?>
        <td data-name="daur_pembelian" <?= $Page->daur_pembelian->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_eoq_daur_pembelian">
<span<?= $Page->daur_pembelian->viewAttributes() ?>>
<?= $Page->daur_pembelian->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowCount);
?>
    </tr>
<?php
    }
    if (!$Page->isGridAdd()) {
        $Page->Recordset->moveNext();
    }
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$Page->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php
// Close recordset
if ($Page->Recordset) {
    $Page->Recordset->close();
}
?>
<?php if (!$Page->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$Page->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?= CurrentPageUrl(false) ?>">
<?= $Page->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($Page->TotalRecords == 0 && !$Page->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("eoq");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
