<?php

namespace PHPMaker2021\eoq;

// Page object
$PemesananList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fpemesananlist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fpemesananlist = currentForm = new ew.Form("fpemesananlist", "list");
    fpemesananlist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fpemesananlist");
});
var fpemesananlistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fpemesananlistsrch = currentSearchForm = new ew.Form("fpemesananlistsrch");

    // Dynamic selection lists

    // Filters
    fpemesananlistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fpemesananlistsrch");
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
<form name="fpemesananlistsrch" id="fpemesananlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fpemesananlistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="pemesanan">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> pemesanan">
<form name="fpemesananlist" id="fpemesananlist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="pemesanan">
<div id="gmp_pemesanan" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_pemesananlist" class="table ew-table"><!-- .ew-table -->
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
<?php if ($Page->id_pesanan->Visible) { // id_pesanan ?>
        <th data-name="id_pesanan" class="<?= $Page->id_pesanan->headerCellClass() ?>"><div id="elh_pemesanan_id_pesanan" class="pemesanan_id_pesanan"><?= $Page->renderSort($Page->id_pesanan) ?></div></th>
<?php } ?>
<?php if ($Page->nama_pemesan->Visible) { // nama_pemesan ?>
        <th data-name="nama_pemesan" class="<?= $Page->nama_pemesan->headerCellClass() ?>"><div id="elh_pemesanan_nama_pemesan" class="pemesanan_nama_pemesan"><?= $Page->renderSort($Page->nama_pemesan) ?></div></th>
<?php } ?>
<?php if ($Page->id_barang->Visible) { // id_barang ?>
        <th data-name="id_barang" class="<?= $Page->id_barang->headerCellClass() ?>"><div id="elh_pemesanan_id_barang" class="pemesanan_id_barang"><?= $Page->renderSort($Page->id_barang) ?></div></th>
<?php } ?>
<?php if ($Page->jumlah_pesanan->Visible) { // jumlah_pesanan ?>
        <th data-name="jumlah_pesanan" class="<?= $Page->jumlah_pesanan->headerCellClass() ?>"><div id="elh_pemesanan_jumlah_pesanan" class="pemesanan_jumlah_pesanan"><?= $Page->renderSort($Page->jumlah_pesanan) ?></div></th>
<?php } ?>
<?php if ($Page->lead_time->Visible) { // lead_time ?>
        <th data-name="lead_time" class="<?= $Page->lead_time->headerCellClass() ?>"><div id="elh_pemesanan_lead_time" class="pemesanan_lead_time"><?= $Page->renderSort($Page->lead_time) ?></div></th>
<?php } ?>
<?php if ($Page->pakai->Visible) { // pakai ?>
        <th data-name="pakai" class="<?= $Page->pakai->headerCellClass() ?>"><div id="elh_pemesanan_pakai" class="pemesanan_pakai"><?= $Page->renderSort($Page->pakai) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_pemesanan", "data-rowtype" => $Page->RowType]);

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
    <?php if ($Page->id_pesanan->Visible) { // id_pesanan ?>
        <td data-name="id_pesanan" <?= $Page->id_pesanan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pemesanan_id_pesanan">
<span<?= $Page->id_pesanan->viewAttributes() ?>>
<?= $Page->id_pesanan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->nama_pemesan->Visible) { // nama_pemesan ?>
        <td data-name="nama_pemesan" <?= $Page->nama_pemesan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pemesanan_nama_pemesan">
<span<?= $Page->nama_pemesan->viewAttributes() ?>>
<?= $Page->nama_pemesan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->id_barang->Visible) { // id_barang ?>
        <td data-name="id_barang" <?= $Page->id_barang->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pemesanan_id_barang">
<span<?= $Page->id_barang->viewAttributes() ?>>
<?= $Page->id_barang->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->jumlah_pesanan->Visible) { // jumlah_pesanan ?>
        <td data-name="jumlah_pesanan" <?= $Page->jumlah_pesanan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pemesanan_jumlah_pesanan">
<span<?= $Page->jumlah_pesanan->viewAttributes() ?>>
<?= $Page->jumlah_pesanan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->lead_time->Visible) { // lead_time ?>
        <td data-name="lead_time" <?= $Page->lead_time->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pemesanan_lead_time">
<span<?= $Page->lead_time->viewAttributes() ?>>
<?= $Page->lead_time->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->pakai->Visible) { // pakai ?>
        <td data-name="pakai" <?= $Page->pakai->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pemesanan_pakai">
<span<?= $Page->pakai->viewAttributes() ?>>
<?= $Page->pakai->getViewValue() ?></span>
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
    ew.addEventHandlers("pemesanan");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
