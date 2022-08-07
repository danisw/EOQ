<?php

namespace PHPMaker2021\eoq;

// Page object
$PengambilanList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fpengambilanlist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fpengambilanlist = currentForm = new ew.Form("fpengambilanlist", "list");
    fpengambilanlist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fpengambilanlist");
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
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$Page->renderOtherOptions();
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> pengambilan">
<form name="fpengambilanlist" id="fpengambilanlist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="pengambilan">
<div id="gmp_pengambilan" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_pengambilanlist" class="table ew-table"><!-- .ew-table -->
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
<?php if ($Page->id_pengambilan->Visible) { // id_pengambilan ?>
        <th data-name="id_pengambilan" class="<?= $Page->id_pengambilan->headerCellClass() ?>"><div id="elh_pengambilan_id_pengambilan" class="pengambilan_id_pengambilan"><?= $Page->renderSort($Page->id_pengambilan) ?></div></th>
<?php } ?>
<?php if ($Page->id_barang->Visible) { // id_barang ?>
        <th data-name="id_barang" class="<?= $Page->id_barang->headerCellClass() ?>"><div id="elh_pengambilan_id_barang" class="pengambilan_id_barang"><?= $Page->renderSort($Page->id_barang) ?></div></th>
<?php } ?>
<?php if ($Page->jumlah_pengambilan->Visible) { // jumlah_pengambilan ?>
        <th data-name="jumlah_pengambilan" class="<?= $Page->jumlah_pengambilan->headerCellClass() ?>"><div id="elh_pengambilan_jumlah_pengambilan" class="pengambilan_jumlah_pengambilan"><?= $Page->renderSort($Page->jumlah_pengambilan) ?></div></th>
<?php } ?>
<?php if ($Page->date->Visible) { // date ?>
        <th data-name="date" class="<?= $Page->date->headerCellClass() ?>"><div id="elh_pengambilan_date" class="pengambilan_date"><?= $Page->renderSort($Page->date) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_pengambilan", "data-rowtype" => $Page->RowType]);

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
    <?php if ($Page->id_pengambilan->Visible) { // id_pengambilan ?>
        <td data-name="id_pengambilan" <?= $Page->id_pengambilan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pengambilan_id_pengambilan">
<span<?= $Page->id_pengambilan->viewAttributes() ?>>
<?= $Page->id_pengambilan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->id_barang->Visible) { // id_barang ?>
        <td data-name="id_barang" <?= $Page->id_barang->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pengambilan_id_barang">
<span<?= $Page->id_barang->viewAttributes() ?>>
<?= $Page->id_barang->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->jumlah_pengambilan->Visible) { // jumlah_pengambilan ?>
        <td data-name="jumlah_pengambilan" <?= $Page->jumlah_pengambilan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pengambilan_jumlah_pengambilan">
<span<?= $Page->jumlah_pengambilan->viewAttributes() ?>>
<?= $Page->jumlah_pengambilan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->date->Visible) { // date ?>
        <td data-name="date" <?= $Page->date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pengambilan_date">
<span<?= $Page->date->viewAttributes() ?>>
<?= $Page->date->getViewValue() ?></span>
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
    ew.addEventHandlers("pengambilan");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
