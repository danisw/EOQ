<?php

namespace PHPMaker2021\eoq;

// Page object
$BagianView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fbagianview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fbagianview = currentForm = new ew.Form("fbagianview", "view");
    loadjs.done("fbagianview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.bagian) ew.vars.tables.bagian = <?= JsonEncode(GetClientVar("tables", "bagian")) ?>;
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
<form name="fbagianview" id="fbagianview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="bagian">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id_bagian->Visible) { // id_bagian ?>
    <tr id="r_id_bagian">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_bagian_id_bagian"><?= $Page->id_bagian->caption() ?></span></td>
        <td data-name="id_bagian" <?= $Page->id_bagian->cellAttributes() ?>>
<span id="el_bagian_id_bagian">
<span<?= $Page->id_bagian->viewAttributes() ?>>
<?= $Page->id_bagian->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nama_bagian->Visible) { // nama_bagian ?>
    <tr id="r_nama_bagian">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_bagian_nama_bagian"><?= $Page->nama_bagian->caption() ?></span></td>
        <td data-name="nama_bagian" <?= $Page->nama_bagian->cellAttributes() ?>>
<span id="el_bagian_nama_bagian">
<span<?= $Page->nama_bagian->viewAttributes() ?>>
<?= $Page->nama_bagian->getViewValue() ?></span>
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
