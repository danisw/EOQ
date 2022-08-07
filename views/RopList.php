<?php

namespace PHPMaker2021\eoq;

// Page object
$RopList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var froplist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    froplist = currentForm = new ew.Form("froplist", "list");
    froplist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("froplist");
});
var froplistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    froplistsrch = currentSearchForm = new ew.Form("froplistsrch");

    // Dynamic selection lists

    // Filters
    froplistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("froplistsrch");
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
<form name="froplistsrch" id="froplistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="froplistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="rop">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> rop">
<form name="froplist" id="froplist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="rop">
<div id="gmp_rop" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_roplist" class="table ew-table"><!-- .ew-table -->
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
        <th data-name="nama_barang" class="<?= $Page->nama_barang->headerCellClass() ?>"><div id="elh_rop_nama_barang" class="rop_nama_barang"><?= $Page->renderSort($Page->nama_barang) ?></div></th>
<?php } ?>
<?php if ($Page->harga_barang->Visible) { // harga_barang ?>
        <th data-name="harga_barang" class="<?= $Page->harga_barang->headerCellClass() ?>"><div id="elh_rop_harga_barang" class="rop_harga_barang"><?= $Page->renderSort($Page->harga_barang) ?></div></th>
<?php } ?>
<?php if ($Page->satuan->Visible) { // satuan ?>
        <th data-name="satuan" class="<?= $Page->satuan->headerCellClass() ?>"><div id="elh_rop_satuan" class="rop_satuan"><?= $Page->renderSort($Page->satuan) ?></div></th>
<?php } ?>
<?php if ($Page->konversi->Visible) { // konversi ?>
        <th data-name="konversi" class="<?= $Page->konversi->headerCellClass() ?>"><div id="elh_rop_konversi" class="rop_konversi"><?= $Page->renderSort($Page->konversi) ?></div></th>
<?php } ?>
<?php if ($Page->lead_time->Visible) { // lead_time ?>
        <th data-name="lead_time" class="<?= $Page->lead_time->headerCellClass() ?>"><div id="elh_rop_lead_time" class="rop_lead_time"><?= $Page->renderSort($Page->lead_time) ?></div></th>
<?php } ?>
<?php if ($Page->pesanan_total->Visible) { // pesanan_total ?>
        <th data-name="pesanan_total" class="<?= $Page->pesanan_total->headerCellClass() ?>"><div id="elh_rop_pesanan_total" class="rop_pesanan_total"><?= $Page->renderSort($Page->pesanan_total) ?></div></th>
<?php } ?>
<?php if ($Page->total_barang->Visible) { // total_barang ?>
        <th data-name="total_barang" class="<?= $Page->total_barang->headerCellClass() ?>"><div id="elh_rop_total_barang" class="rop_total_barang"><?= $Page->renderSort($Page->total_barang) ?></div></th>
<?php } ?>
<?php if ($Page->X->Visible) { // X ?>
        <th data-name="X" class="<?= $Page->X->headerCellClass() ?>"><div id="elh_rop_X" class="rop_X"><?= $Page->renderSort($Page->X) ?></div></th>
<?php } ?>
<?php if ($Page->Y->Visible) { // Y ?>
        <th data-name="Y" class="<?= $Page->Y->headerCellClass() ?>"><div id="elh_rop_Y" class="rop_Y"><?= $Page->renderSort($Page->Y) ?></div></th>
<?php } ?>
<?php if ($Page->XY->Visible) { // X-Y ?>
        <th data-name="XY" class="<?= $Page->XY->headerCellClass() ?>"><div id="elh_rop_XY" class="rop_XY"><?= $Page->renderSort($Page->XY) ?></div></th>
<?php } ?>
<?php if ($Page->XY2->Visible) { // X-Y^2 ?>
        <th data-name="XY2" class="<?= $Page->XY2->headerCellClass() ?>"><div id="elh_rop_XY2" class="rop_XY2"><?= $Page->renderSort($Page->XY2) ?></div></th>
<?php } ?>
<?php if ($Page->sigma->Visible) { // sigma ?>
        <th data-name="sigma" class="<?= $Page->sigma->headerCellClass() ?>"><div id="elh_rop_sigma" class="rop_sigma"><?= $Page->renderSort($Page->sigma) ?></div></th>
<?php } ?>
<?php if ($Page->safety_stock->Visible) { // safety_stock ?>
        <th data-name="safety_stock" class="<?= $Page->safety_stock->headerCellClass() ?>"><div id="elh_rop_safety_stock" class="rop_safety_stock"><?= $Page->renderSort($Page->safety_stock) ?></div></th>
<?php } ?>
<?php if ($Page->LQ->Visible) { // LQ ?>
        <th data-name="LQ" class="<?= $Page->LQ->headerCellClass() ?>"><div id="elh_rop_LQ" class="rop_LQ"><?= $Page->renderSort($Page->LQ) ?></div></th>
<?php } ?>
<?php if ($Page->ROP->Visible) { // ROP ?>
        <th data-name="ROP" class="<?= $Page->ROP->headerCellClass() ?>"><div id="elh_rop_ROP" class="rop_ROP"><?= $Page->renderSort($Page->ROP) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_rop", "data-rowtype" => $Page->RowType]);

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
<span id="el<?= $Page->RowCount ?>_rop_nama_barang">
<span<?= $Page->nama_barang->viewAttributes() ?>>
<?= $Page->nama_barang->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->harga_barang->Visible) { // harga_barang ?>
        <td data-name="harga_barang" <?= $Page->harga_barang->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_rop_harga_barang">
<span<?= $Page->harga_barang->viewAttributes() ?>>
<?= $Page->harga_barang->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->satuan->Visible) { // satuan ?>
        <td data-name="satuan" <?= $Page->satuan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_rop_satuan">
<span<?= $Page->satuan->viewAttributes() ?>>
<?= $Page->satuan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->konversi->Visible) { // konversi ?>
        <td data-name="konversi" <?= $Page->konversi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_rop_konversi">
<span<?= $Page->konversi->viewAttributes() ?>>
<?= $Page->konversi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->lead_time->Visible) { // lead_time ?>
        <td data-name="lead_time" <?= $Page->lead_time->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_rop_lead_time">
<span<?= $Page->lead_time->viewAttributes() ?>>
<?= $Page->lead_time->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->pesanan_total->Visible) { // pesanan_total ?>
        <td data-name="pesanan_total" <?= $Page->pesanan_total->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_rop_pesanan_total">
<span<?= $Page->pesanan_total->viewAttributes() ?>>
<?= $Page->pesanan_total->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->total_barang->Visible) { // total_barang ?>
        <td data-name="total_barang" <?= $Page->total_barang->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_rop_total_barang">
<span<?= $Page->total_barang->viewAttributes() ?>>
<?= $Page->total_barang->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->X->Visible) { // X ?>
        <td data-name="X" <?= $Page->X->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_rop_X">
<span<?= $Page->X->viewAttributes() ?>>
<?= $Page->X->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Y->Visible) { // Y ?>
        <td data-name="Y" <?= $Page->Y->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_rop_Y">
<span<?= $Page->Y->viewAttributes() ?>>
<?= $Page->Y->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->XY->Visible) { // X-Y ?>
        <td data-name="XY" <?= $Page->XY->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_rop_XY">
<span<?= $Page->XY->viewAttributes() ?>>
<?= $Page->XY->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->XY2->Visible) { // X-Y^2 ?>
        <td data-name="XY2" <?= $Page->XY2->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_rop_XY2">
<span<?= $Page->XY2->viewAttributes() ?>>
<?= $Page->XY2->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->sigma->Visible) { // sigma ?>
        <td data-name="sigma" <?= $Page->sigma->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_rop_sigma">
<span<?= $Page->sigma->viewAttributes() ?>>
<?= $Page->sigma->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->safety_stock->Visible) { // safety_stock ?>
        <td data-name="safety_stock" <?= $Page->safety_stock->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_rop_safety_stock">
<span<?= $Page->safety_stock->viewAttributes() ?>>
<?= $Page->safety_stock->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->LQ->Visible) { // LQ ?>
        <td data-name="LQ" <?= $Page->LQ->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_rop_LQ">
<span<?= $Page->LQ->viewAttributes() ?>>
<?= $Page->LQ->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ROP->Visible) { // ROP ?>
        <td data-name="ROP" <?= $Page->ROP->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_rop_ROP">
<span<?= $Page->ROP->viewAttributes() ?>>
<?= $Page->ROP->getViewValue() ?></span>
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
    ew.addEventHandlers("rop");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
