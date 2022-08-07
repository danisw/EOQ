<?php

namespace PHPMaker2021\eoq;

// Page object
$PengambilanView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fpengambilanview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fpengambilanview = currentForm = new ew.Form("fpengambilanview", "view");
    loadjs.done("fpengambilanview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.pengambilan) ew.vars.tables.pengambilan = <?= JsonEncode(GetClientVar("tables", "pengambilan")) ?>;
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
<form name="fpengambilanview" id="fpengambilanview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="pengambilan">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id_pengambilan->Visible) { // id_pengambilan ?>
    <tr id="r_id_pengambilan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pengambilan_id_pengambilan"><?= $Page->id_pengambilan->caption() ?></span></td>
        <td data-name="id_pengambilan" <?= $Page->id_pengambilan->cellAttributes() ?>>
<span id="el_pengambilan_id_pengambilan">
<span<?= $Page->id_pengambilan->viewAttributes() ?>>
<?= $Page->id_pengambilan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->id_barang->Visible) { // id_barang ?>
    <tr id="r_id_barang">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pengambilan_id_barang"><?= $Page->id_barang->caption() ?></span></td>
        <td data-name="id_barang" <?= $Page->id_barang->cellAttributes() ?>>
<span id="el_pengambilan_id_barang">
<span<?= $Page->id_barang->viewAttributes() ?>>
<?= $Page->id_barang->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->jumlah_pengambilan->Visible) { // jumlah_pengambilan ?>
    <tr id="r_jumlah_pengambilan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pengambilan_jumlah_pengambilan"><?= $Page->jumlah_pengambilan->caption() ?></span></td>
        <td data-name="jumlah_pengambilan" <?= $Page->jumlah_pengambilan->cellAttributes() ?>>
<span id="el_pengambilan_jumlah_pengambilan">
<span<?= $Page->jumlah_pengambilan->viewAttributes() ?>>
<?= $Page->jumlah_pengambilan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->date->Visible) { // date ?>
    <tr id="r_date">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pengambilan_date"><?= $Page->date->caption() ?></span></td>
        <td data-name="date" <?= $Page->date->cellAttributes() ?>>
<span id="el_pengambilan_date">
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
