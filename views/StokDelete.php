<?php

namespace PHPMaker2021\eoq;

// Page object
$StokDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fstokdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fstokdelete = currentForm = new ew.Form("fstokdelete", "delete");
    loadjs.done("fstokdelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.stok) ew.vars.tables.stok = <?= JsonEncode(GetClientVar("tables", "stok")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fstokdelete" id="fstokdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="stok">
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
<?php if ($Page->id_barang->Visible) { // id_barang ?>
        <th class="<?= $Page->id_barang->headerCellClass() ?>"><span id="elh_stok_id_barang" class="stok_id_barang"><?= $Page->id_barang->caption() ?></span></th>
<?php } ?>
<?php if ($Page->curret_qty->Visible) { // curret_qty ?>
        <th class="<?= $Page->curret_qty->headerCellClass() ?>"><span id="elh_stok_curret_qty" class="stok_curret_qty"><?= $Page->curret_qty->caption() ?></span></th>
<?php } ?>
<?php if ($Page->last_update->Visible) { // last_update ?>
        <th class="<?= $Page->last_update->headerCellClass() ?>"><span id="elh_stok_last_update" class="stok_last_update"><?= $Page->last_update->caption() ?></span></th>
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
<?php if ($Page->id_barang->Visible) { // id_barang ?>
        <td <?= $Page->id_barang->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_stok_id_barang" class="stok_id_barang">
<span<?= $Page->id_barang->viewAttributes() ?>>
<?= $Page->id_barang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->curret_qty->Visible) { // curret_qty ?>
        <td <?= $Page->curret_qty->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_stok_curret_qty" class="stok_curret_qty">
<span<?= $Page->curret_qty->viewAttributes() ?>>
<?= $Page->curret_qty->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->last_update->Visible) { // last_update ?>
        <td <?= $Page->last_update->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_stok_last_update" class="stok_last_update">
<span<?= $Page->last_update->viewAttributes() ?>>
<?= $Page->last_update->getViewValue() ?></span>
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
