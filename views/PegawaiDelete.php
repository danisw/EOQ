<?php

namespace PHPMaker2021\eoq;

// Page object
$PegawaiDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fpegawaidelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fpegawaidelete = currentForm = new ew.Form("fpegawaidelete", "delete");
    loadjs.done("fpegawaidelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.pegawai) ew.vars.tables.pegawai = <?= JsonEncode(GetClientVar("tables", "pegawai")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fpegawaidelete" id="fpegawaidelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="pegawai">
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
<?php if ($Page->id_pegawai->Visible) { // id_pegawai ?>
        <th class="<?= $Page->id_pegawai->headerCellClass() ?>"><span id="elh_pegawai_id_pegawai" class="pegawai_id_pegawai"><?= $Page->id_pegawai->caption() ?></span></th>
<?php } ?>
<?php if ($Page->_username->Visible) { // username ?>
        <th class="<?= $Page->_username->headerCellClass() ?>"><span id="elh_pegawai__username" class="pegawai__username"><?= $Page->_username->caption() ?></span></th>
<?php } ?>
<?php if ($Page->_password->Visible) { // password ?>
        <th class="<?= $Page->_password->headerCellClass() ?>"><span id="elh_pegawai__password" class="pegawai__password"><?= $Page->_password->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nama_pegawai->Visible) { // nama_pegawai ?>
        <th class="<?= $Page->nama_pegawai->headerCellClass() ?>"><span id="elh_pegawai_nama_pegawai" class="pegawai_nama_pegawai"><?= $Page->nama_pegawai->caption() ?></span></th>
<?php } ?>
<?php if ($Page->alamat_pegawai->Visible) { // alamat_pegawai ?>
        <th class="<?= $Page->alamat_pegawai->headerCellClass() ?>"><span id="elh_pegawai_alamat_pegawai" class="pegawai_alamat_pegawai"><?= $Page->alamat_pegawai->caption() ?></span></th>
<?php } ?>
<?php if ($Page->hp_pegawai->Visible) { // hp_pegawai ?>
        <th class="<?= $Page->hp_pegawai->headerCellClass() ?>"><span id="elh_pegawai_hp_pegawai" class="pegawai_hp_pegawai"><?= $Page->hp_pegawai->caption() ?></span></th>
<?php } ?>
<?php if ($Page->id_bagian->Visible) { // id_bagian ?>
        <th class="<?= $Page->id_bagian->headerCellClass() ?>"><span id="elh_pegawai_id_bagian" class="pegawai_id_bagian"><?= $Page->id_bagian->caption() ?></span></th>
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
<?php if ($Page->id_pegawai->Visible) { // id_pegawai ?>
        <td <?= $Page->id_pegawai->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pegawai_id_pegawai" class="pegawai_id_pegawai">
<span<?= $Page->id_pegawai->viewAttributes() ?>>
<?= $Page->id_pegawai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->_username->Visible) { // username ?>
        <td <?= $Page->_username->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pegawai__username" class="pegawai__username">
<span<?= $Page->_username->viewAttributes() ?>>
<?= $Page->_username->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->_password->Visible) { // password ?>
        <td <?= $Page->_password->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pegawai__password" class="pegawai__password">
<span<?= $Page->_password->viewAttributes() ?>>
<?= $Page->_password->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nama_pegawai->Visible) { // nama_pegawai ?>
        <td <?= $Page->nama_pegawai->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pegawai_nama_pegawai" class="pegawai_nama_pegawai">
<span<?= $Page->nama_pegawai->viewAttributes() ?>>
<?= $Page->nama_pegawai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->alamat_pegawai->Visible) { // alamat_pegawai ?>
        <td <?= $Page->alamat_pegawai->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pegawai_alamat_pegawai" class="pegawai_alamat_pegawai">
<span<?= $Page->alamat_pegawai->viewAttributes() ?>>
<?= $Page->alamat_pegawai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->hp_pegawai->Visible) { // hp_pegawai ?>
        <td <?= $Page->hp_pegawai->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pegawai_hp_pegawai" class="pegawai_hp_pegawai">
<span<?= $Page->hp_pegawai->viewAttributes() ?>>
<?= $Page->hp_pegawai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->id_bagian->Visible) { // id_bagian ?>
        <td <?= $Page->id_bagian->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pegawai_id_bagian" class="pegawai_id_bagian">
<span<?= $Page->id_bagian->viewAttributes() ?>>
<?= $Page->id_bagian->getViewValue() ?></span>
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
