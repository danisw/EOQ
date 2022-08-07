<?php

namespace PHPMaker2021\eoq;

// Page object
$ProduksiView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fproduksiview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fproduksiview = currentForm = new ew.Form("fproduksiview", "view");
    loadjs.done("fproduksiview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.produksi) ew.vars.tables.produksi = <?= JsonEncode(GetClientVar("tables", "produksi")) ?>;
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
<form name="fproduksiview" id="fproduksiview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="produksi">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id_produksi->Visible) { // id_produksi ?>
    <tr id="r_id_produksi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_produksi_id_produksi"><?= $Page->id_produksi->caption() ?></span></td>
        <td data-name="id_produksi" <?= $Page->id_produksi->cellAttributes() ?>>
<span id="el_produksi_id_produksi">
<span<?= $Page->id_produksi->viewAttributes() ?>>
<?= $Page->id_produksi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->id_barang->Visible) { // id_barang ?>
    <tr id="r_id_barang">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_produksi_id_barang"><?= $Page->id_barang->caption() ?></span></td>
        <td data-name="id_barang" <?= $Page->id_barang->cellAttributes() ?>>
<span id="el_produksi_id_barang">
<span<?= $Page->id_barang->viewAttributes() ?>>
<?= $Page->id_barang->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->jumlah_produksi->Visible) { // jumlah_produksi ?>
    <tr id="r_jumlah_produksi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_produksi_jumlah_produksi"><?= $Page->jumlah_produksi->caption() ?></span></td>
        <td data-name="jumlah_produksi" <?= $Page->jumlah_produksi->cellAttributes() ?>>
<span id="el_produksi_jumlah_produksi">
<span<?= $Page->jumlah_produksi->viewAttributes() ?>>
<?= $Page->jumlah_produksi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->date->Visible) { // date ?>
    <tr id="r_date">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_produksi_date"><?= $Page->date->caption() ?></span></td>
        <td data-name="date" <?= $Page->date->cellAttributes() ?>>
<span id="el_produksi_date">
<span<?= $Page->date->viewAttributes() ?>>
<?= $Page->date->getViewValue() ?></span>
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
