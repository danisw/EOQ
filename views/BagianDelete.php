<?php

namespace PHPMaker2021\eoq;

// Page object
$BagianDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fbagiandelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fbagiandelete = currentForm = new ew.Form("fbagiandelete", "delete");
    loadjs.done("fbagiandelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.bagian) ew.vars.tables.bagian = <?= JsonEncode(GetClientVar("tables", "bagian")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fbagiandelete" id="fbagiandelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="bagian">
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
<?php if ($Page->id_bagian->Visible) { // id_bagian ?>
        <th class="<?= $Page->id_bagian->headerCellClass() ?>"><span id="elh_bagian_id_bagian" class="bagian_id_bagian"><?= $Page->id_bagian->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nama_bagian->Visible) { // nama_bagian ?>
        <th class="<?= $Page->nama_bagian->headerCellClass() ?>"><span id="elh_bagian_nama_bagian" class="bagian_nama_bagian"><?= $Page->nama_bagian->caption() ?></span></th>
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
<?php if ($Page->id_bagian->Visible) { // id_bagian ?>
        <td <?= $Page->id_bagian->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bagian_id_bagian" class="bagian_id_bagian">
<span<?= $Page->id_bagian->viewAttributes() ?>>
<?= $Page->id_bagian->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nama_bagian->Visible) { // nama_bagian ?>
        <td <?= $Page->nama_bagian->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bagian_nama_bagian" class="bagian_nama_bagian">
<span<?= $Page->nama_bagian->viewAttributes() ?>>
<?= $Page->nama_bagian->getViewValue() ?></span>
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
