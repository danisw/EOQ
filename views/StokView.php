<?php

namespace PHPMaker2021\eoq;

// Page object
$StokView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fstokview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fstokview = currentForm = new ew.Form("fstokview", "view");
    loadjs.done("fstokview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.stok) ew.vars.tables.stok = <?= JsonEncode(GetClientVar("tables", "stok")) ?>;
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
<form name="fstokview" id="fstokview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="stok">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id_barang->Visible) { // id_barang ?>
    <tr id="r_id_barang">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_stok_id_barang"><?= $Page->id_barang->caption() ?></span></td>
        <td data-name="id_barang" <?= $Page->id_barang->cellAttributes() ?>>
<span id="el_stok_id_barang">
<span<?= $Page->id_barang->viewAttributes() ?>>
<?= $Page->id_barang->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->curret_qty->Visible) { // curret_qty ?>
    <tr id="r_curret_qty">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_stok_curret_qty"><?= $Page->curret_qty->caption() ?></span></td>
        <td data-name="curret_qty" <?= $Page->curret_qty->cellAttributes() ?>>
<span id="el_stok_curret_qty">
<span<?= $Page->curret_qty->viewAttributes() ?>>
<?= $Page->curret_qty->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->last_update->Visible) { // last_update ?>
    <tr id="r_last_update">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_stok_last_update"><?= $Page->last_update->caption() ?></span></td>
        <td data-name="last_update" <?= $Page->last_update->cellAttributes() ?>>
<span id="el_stok_last_update">
<span<?= $Page->last_update->viewAttributes() ?>>
<?= $Page->last_update->getViewValue() ?></span>
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
