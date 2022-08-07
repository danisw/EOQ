<?php

namespace PHPMaker2021\eoq;

// Page object
$ProduksiDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fproduksidelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fproduksidelete = currentForm = new ew.Form("fproduksidelete", "delete");
    loadjs.done("fproduksidelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.produksi) ew.vars.tables.produksi = <?= JsonEncode(GetClientVar("tables", "produksi")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fproduksidelete" id="fproduksidelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="produksi">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
    <thead>
    <tr class="ew-table-header">
<?php if ($Page->id_produksi->Visible) { // id_produksi ?>
        <th class="<?= $Page->id_produksi->headerCellClass() ?>"><span id="elh_produksi_id_produksi" class="produksi_id_produksi"><?= $Page->id_produksi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->id_barang->Visible) { // id_barang ?>
        <th class="<?= $Page->id_barang->headerCellClass() ?>"><span id="elh_produksi_id_barang" class="produksi_id_barang"><?= $Page->id_barang->caption() ?></span></th>
<?php } ?>
<?php if ($Page->jumlah_produksi->Visible) { // jumlah_produksi ?>
        <th class="<?= $Page->jumlah_produksi->headerCellClass() ?>"><span id="elh_produksi_jumlah_produksi" class="produksi_jumlah_produksi"><?= $Page->jumlah_produksi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date->Visible) { // date ?>
        <th class="<?= $Page->date->headerCellClass() ?>"><span id="elh_produksi_date" class="produksi_date"><?= $Page->date->caption() ?></span></th>
<?php } ?>
    </tr>
    </thead>
    <tbody>
<?php
$Page->RecordCount = 0;
$i = 0;
while (!$Page->Recordset->EOF) {
    $Page->RecordCount++;
    $Page->RowCount++;

    // Set row properties
    $Page->resetAttributes();
    $Page->RowType = ROWTYPE_VIEW; // View

    // Get the field contents
    $Page->loadRowValues($Page->Recordset);

    // Render row
    $Page->renderRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php if ($Page->id_produksi->Visible) { // id_produksi ?>
        <td <?= $Page->id_produksi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_produksi_id_produksi" class="produksi_id_produksi">
<span<?= $Page->id_produksi->viewAttributes() ?>>
<?= $Page->id_produksi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->id_barang->Visible) { // id_barang ?>
        <td <?= $Page->id_barang->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_produksi_id_barang" class="produksi_id_barang">
<span<?= $Page->id_barang->viewAttributes() ?>>
<?= $Page->id_barang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->jumlah_produksi->Visible) { // jumlah_produksi ?>
        <td <?= $Page->jumlah_produksi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_produksi_jumlah_produksi" class="produksi_jumlah_produksi">
<span<?= $Page->jumlah_produksi->viewAttributes() ?>>
<?= $Page->jumlah_produksi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->date->Visible) { // date ?>
        <td <?= $Page->date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_produksi_date" class="produksi_date">
<span<?= $Page->date->viewAttributes() ?>>
<?= $Page->date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
    </tr>
<?php
    $Page->Recordset->moveNext();
}
$Page->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
