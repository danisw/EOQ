<?php

namespace PHPMaker2021\eoq;

// Page object
$PegawaiView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fpegawaiview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fpegawaiview = currentForm = new ew.Form("fpegawaiview", "view");
    loadjs.done("fpegawaiview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.pegawai) ew.vars.tables.pegawai = <?= JsonEncode(GetClientVar("tables", "pegawai")) ?>;
</script>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Page->ExportOptions->render("body") ?>
<?php $Page->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fpegawaiview" id="fpegawaiview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="pegawai">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id_pegawai->Visible) { // id_pegawai ?>
    <tr id="r_id_pegawai">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pegawai_id_pegawai"><?= $Page->id_pegawai->caption() ?></span></td>
        <td data-name="id_pegawai" <?= $Page->id_pegawai->cellAttributes() ?>>
<span id="el_pegawai_id_pegawai">
<span<?= $Page->id_pegawai->viewAttributes() ?>>
<?= $Page->id_pegawai->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->_username->Visible) { // username ?>
    <tr id="r__username">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pegawai__username"><?= $Page->_username->caption() ?></span></td>
        <td data-name="_username" <?= $Page->_username->cellAttributes() ?>>
<span id="el_pegawai__username">
<span<?= $Page->_username->viewAttributes() ?>>
<?= $Page->_username->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->_password->Visible) { // password ?>
    <tr id="r__password">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pegawai__password"><?= $Page->_password->caption() ?></span></td>
        <td data-name="_password" <?= $Page->_password->cellAttributes() ?>>
<span id="el_pegawai__password">
<span<?= $Page->_password->viewAttributes() ?>>
<?= $Page->_password->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nama_pegawai->Visible) { // nama_pegawai ?>
    <tr id="r_nama_pegawai">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pegawai_nama_pegawai"><?= $Page->nama_pegawai->caption() ?></span></td>
        <td data-name="nama_pegawai" <?= $Page->nama_pegawai->cellAttributes() ?>>
<span id="el_pegawai_nama_pegawai">
<span<?= $Page->nama_pegawai->viewAttributes() ?>>
<?= $Page->nama_pegawai->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->alamat_pegawai->Visible) { // alamat_pegawai ?>
    <tr id="r_alamat_pegawai">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pegawai_alamat_pegawai"><?= $Page->alamat_pegawai->caption() ?></span></td>
        <td data-name="alamat_pegawai" <?= $Page->alamat_pegawai->cellAttributes() ?>>
<span id="el_pegawai_alamat_pegawai">
<span<?= $Page->alamat_pegawai->viewAttributes() ?>>
<?= $Page->alamat_pegawai->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->hp_pegawai->Visible) { // hp_pegawai ?>
    <tr id="r_hp_pegawai">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pegawai_hp_pegawai"><?= $Page->hp_pegawai->caption() ?></span></td>
        <td data-name="hp_pegawai" <?= $Page->hp_pegawai->cellAttributes() ?>>
<span id="el_pegawai_hp_pegawai">
<span<?= $Page->hp_pegawai->viewAttributes() ?>>
<?= $Page->hp_pegawai->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->id_bagian->Visible) { // id_bagian ?>
    <tr id="r_id_bagian">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pegawai_id_bagian"><?= $Page->id_bagian->caption() ?></span></td>
        <td data-name="id_bagian" <?= $Page->id_bagian->cellAttributes() ?>>
<span id="el_pegawai_id_bagian">
<span<?= $Page->id_bagian->viewAttributes() ?>>
<?= $Page->id_bagian->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
