<?php

namespace PHPMaker2021\eoq;

// Page object
$BarangView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fbarangview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fbarangview = currentForm = new ew.Form("fbarangview", "view");
    loadjs.done("fbarangview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.barang) ew.vars.tables.barang = <?= JsonEncode(GetClientVar("tables", "barang")) ?>;
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
<form name="fbarangview" id="fbarangview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="barang">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id_barang->Visible) { // id_barang ?>
    <tr id="r_id_barang">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_barang_id_barang"><?= $Page->id_barang->caption() ?></span></td>
        <td data-name="id_barang" <?= $Page->id_barang->cellAttributes() ?>>
<span id="el_barang_id_barang">
<span<?= $Page->id_barang->viewAttributes() ?>>
<?= $Page->id_barang->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nama_barang->Visible) { // nama_barang ?>
    <tr id="r_nama_barang">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_barang_nama_barang"><?= $Page->nama_barang->caption() ?></span></td>
        <td data-name="nama_barang" <?= $Page->nama_barang->cellAttributes() ?>>
<span id="el_barang_nama_barang">
<span<?= $Page->nama_barang->viewAttributes() ?>>
<?= $Page->nama_barang->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->harga_barang->Visible) { // harga_barang ?>
    <tr id="r_harga_barang">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_barang_harga_barang"><?= $Page->harga_barang->caption() ?></span></td>
        <td data-name="harga_barang" <?= $Page->harga_barang->cellAttributes() ?>>
<span id="el_barang_harga_barang">
<span<?= $Page->harga_barang->viewAttributes() ?>>
<?= $Page->harga_barang->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->biaya_penyimpanan->Visible) { // biaya_penyimpanan ?>
    <tr id="r_biaya_penyimpanan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_barang_biaya_penyimpanan"><?= $Page->biaya_penyimpanan->caption() ?></span></td>
        <td data-name="biaya_penyimpanan" <?= $Page->biaya_penyimpanan->cellAttributes() ?>>
<span id="el_barang_biaya_penyimpanan">
<span<?= $Page->biaya_penyimpanan->viewAttributes() ?>>
<?= $Page->biaya_penyimpanan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->periode_permintaan->Visible) { // periode_permintaan ?>
    <tr id="r_periode_permintaan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_barang_periode_permintaan"><?= $Page->periode_permintaan->caption() ?></span></td>
        <td data-name="periode_permintaan" <?= $Page->periode_permintaan->cellAttributes() ?>>
<span id="el_barang_periode_permintaan">
<span<?= $Page->periode_permintaan->viewAttributes() ?>>
<?= $Page->periode_permintaan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->satuan->Visible) { // satuan ?>
    <tr id="r_satuan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_barang_satuan"><?= $Page->satuan->caption() ?></span></td>
        <td data-name="satuan" <?= $Page->satuan->cellAttributes() ?>>
<span id="el_barang_satuan">
<span<?= $Page->satuan->viewAttributes() ?>>
<?= $Page->satuan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->konversi->Visible) { // konversi ?>
    <tr id="r_konversi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_barang_konversi"><?= $Page->konversi->caption() ?></span></td>
        <td data-name="konversi" <?= $Page->konversi->cellAttributes() ?>>
<span id="el_barang_konversi">
<span<?= $Page->konversi->viewAttributes() ?>>
<?= $Page->konversi->getViewValue() ?></span>
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
