<?php

namespace PHPMaker2021\eoq;

// Page object
$PemesananView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fpemesananview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fpemesananview = currentForm = new ew.Form("fpemesananview", "view");
    loadjs.done("fpemesananview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.pemesanan) ew.vars.tables.pemesanan = <?= JsonEncode(GetClientVar("tables", "pemesanan")) ?>;
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
<form name="fpemesananview" id="fpemesananview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="pemesanan">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id_pesanan->Visible) { // id_pesanan ?>
    <tr id="r_id_pesanan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pemesanan_id_pesanan"><?= $Page->id_pesanan->caption() ?></span></td>
        <td data-name="id_pesanan" <?= $Page->id_pesanan->cellAttributes() ?>>
<span id="el_pemesanan_id_pesanan">
<span<?= $Page->id_pesanan->viewAttributes() ?>>
<?= $Page->id_pesanan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nama_pemesan->Visible) { // nama_pemesan ?>
    <tr id="r_nama_pemesan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pemesanan_nama_pemesan"><?= $Page->nama_pemesan->caption() ?></span></td>
        <td data-name="nama_pemesan" <?= $Page->nama_pemesan->cellAttributes() ?>>
<span id="el_pemesanan_nama_pemesan">
<span<?= $Page->nama_pemesan->viewAttributes() ?>>
<?= $Page->nama_pemesan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->id_barang->Visible) { // id_barang ?>
    <tr id="r_id_barang">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pemesanan_id_barang"><?= $Page->id_barang->caption() ?></span></td>
        <td data-name="id_barang" <?= $Page->id_barang->cellAttributes() ?>>
<span id="el_pemesanan_id_barang">
<span<?= $Page->id_barang->viewAttributes() ?>>
<?= $Page->id_barang->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->jumlah_pesanan->Visible) { // jumlah_pesanan ?>
    <tr id="r_jumlah_pesanan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pemesanan_jumlah_pesanan"><?= $Page->jumlah_pesanan->caption() ?></span></td>
        <td data-name="jumlah_pesanan" <?= $Page->jumlah_pesanan->cellAttributes() ?>>
<span id="el_pemesanan_jumlah_pesanan">
<span<?= $Page->jumlah_pesanan->viewAttributes() ?>>
<?= $Page->jumlah_pesanan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->lead_time->Visible) { // lead_time ?>
    <tr id="r_lead_time">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pemesanan_lead_time"><?= $Page->lead_time->caption() ?></span></td>
        <td data-name="lead_time" <?= $Page->lead_time->cellAttributes() ?>>
<span id="el_pemesanan_lead_time">
<span<?= $Page->lead_time->viewAttributes() ?>>
<?= $Page->lead_time->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->pakai->Visible) { // pakai ?>
    <tr id="r_pakai">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pemesanan_pakai"><?= $Page->pakai->caption() ?></span></td>
        <td data-name="pakai" <?= $Page->pakai->cellAttributes() ?>>
<span id="el_pemesanan_pakai">
<span<?= $Page->pakai->viewAttributes() ?>>
<?= $Page->pakai->getViewValue() ?></span>
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
