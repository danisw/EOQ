<?php

namespace PHPMaker2021\eoq;

// Page object
$BarangList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fbaranglist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fbaranglist = currentForm = new ew.Form("fbaranglist", "list");
    fbaranglist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fbaranglist");
});
var fbaranglistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fbaranglistsrch = currentSearchForm = new ew.Form("fbaranglistsrch");

    // Dynamic selection lists

    // Filters
    fbaranglistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fbaranglistsrch");
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
<form name="fbaranglistsrch" id="fbaranglistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fbaranglistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="barang">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> barang">
<form name="fbaranglist" id="fbaranglist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="barang">
<div id="gmp_barang" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_baranglist" class="table ew-table"><!-- .ew-table -->
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
<?php if ($Page->id_barang->Visible) { // id_barang ?>
        <th data-name="id_barang" class="<?= $Page->id_barang->headerCellClass() ?>"><div id="elh_barang_id_barang" class="barang_id_barang"><?= $Page->renderSort($Page->id_barang) ?></div></th>
<?php } ?>
<?php if ($Page->nama_barang->Visible) { // nama_barang ?>
        <th data-name="nama_barang" class="<?= $Page->nama_barang->headerCellClass() ?>"><div id="elh_barang_nama_barang" class="barang_nama_barang"><?= $Page->renderSort($Page->nama_barang) ?></div></th>
<?php } ?>
<?php if ($Page->harga_barang->Visible) { // harga_barang ?>
        <th data-name="harga_barang" class="<?= $Page->harga_barang->headerCellClass() ?>"><div id="elh_barang_harga_barang" class="barang_harga_barang"><?= $Page->renderSort($Page->harga_barang) ?></div></th>
<?php } ?>
<?php if ($Page->biaya_penyimpanan->Visible) { // biaya_penyimpanan ?>
        <th data-name="biaya_penyimpanan" class="<?= $Page->biaya_penyimpanan->headerCellClass() ?>"><div id="elh_barang_biaya_penyimpanan" class="barang_biaya_penyimpanan"><?= $Page->renderSort($Page->biaya_penyimpanan) ?></div></th>
<?php } ?>
<?php if ($Page->periode_permintaan->Visible) { // periode_permintaan ?>
        <th data-name="periode_permintaan" class="<?= $Page->periode_permintaan->headerCellClass() ?>"><div id="elh_barang_periode_permintaan" class="barang_periode_permintaan"><?= $Page->renderSort($Page->periode_permintaan) ?></div></th>
<?php } ?>
<?php if ($Page->satuan->Visible) { // satuan ?>
        <th data-name="satuan" class="<?= $Page->satuan->headerCellClass() ?>"><div id="elh_barang_satuan" class="barang_satuan"><?= $Page->renderSort($Page->satuan) ?></div></th>
<?php } ?>
<?php if ($Page->konversi->Visible) { // konversi ?>
        <th data-name="konversi" class="<?= $Page->konversi->headerCellClass() ?>"><div id="elh_barang_konversi" class="barang_konversi"><?= $Page->renderSort($Page->konversi) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_barang", "data-rowtype" => $Page->RowType]);

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
    <?php if ($Page->id_barang->Visible) { // id_barang ?>
        <td data-name="id_barang" <?= $Page->id_barang->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_barang_id_barang">
<span<?= $Page->id_barang->viewAttributes() ?>>
<?= $Page->id_barang->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->nama_barang->Visible) { // nama_barang ?>
        <td data-name="nama_barang" <?= $Page->nama_barang->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_barang_nama_barang">
<span<?= $Page->nama_barang->viewAttributes() ?>>
<?= $Page->nama_barang->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->harga_barang->Visible) { // harga_barang ?>
        <td data-name="harga_barang" <?= $Page->harga_barang->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_barang_harga_barang">
<span<?= $Page->harga_barang->viewAttributes() ?>>
<?= $Page->harga_barang->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->biaya_penyimpanan->Visible) { // biaya_penyimpanan ?>
        <td data-name="biaya_penyimpanan" <?= $Page->biaya_penyimpanan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_barang_biaya_penyimpanan">
<span<?= $Page->biaya_penyimpanan->viewAttributes() ?>>
<?= $Page->biaya_penyimpanan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->periode_permintaan->Visible) { // periode_permintaan ?>
        <td data-name="periode_permintaan" <?= $Page->periode_permintaan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_barang_periode_permintaan">
<span<?= $Page->periode_permintaan->viewAttributes() ?>>
<?= $Page->periode_permintaan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->satuan->Visible) { // satuan ?>
        <td data-name="satuan" <?= $Page->satuan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_barang_satuan">
<span<?= $Page->satuan->viewAttributes() ?>>
<?= $Page->satuan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->konversi->Visible) { // konversi ?>
        <td data-name="konversi" <?= $Page->konversi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_barang_konversi">
<span<?= $Page->konversi->viewAttributes() ?>>
<?= $Page->konversi->getViewValue() ?></span>
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
    ew.addEventHandlers("barang");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
