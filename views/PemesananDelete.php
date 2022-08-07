<?php

namespace PHPMaker2021\eoq;

// Page object
$PemesananDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fpemesanandelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fpemesanandelete = currentForm = new ew.Form("fpemesanandelete", "delete");
    loadjs.done("fpemesanandelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.pemesanan) ew.vars.tables.pemesanan = <?= JsonEncode(GetClientVar("tables", "pemesanan")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fpemesanandelete" id="fpemesanandelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="pemesanan">
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
<?php if ($Page->id_pesanan->Visible) { // id_pesanan ?>
        <th class="<?= $Page->id_pesanan->headerCellClass() ?>"><span id="elh_pemesanan_id_pesanan" class="pemesanan_id_pesanan"><?= $Page->id_pesanan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nama_pemesan->Visible) { // nama_pemesan ?>
        <th class="<?= $Page->nama_pemesan->headerCellClass() ?>"><span id="elh_pemesanan_nama_pemesan" class="pemesanan_nama_pemesan"><?= $Page->nama_pemesan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->id_barang->Visible) { // id_barang ?>
        <th class="<?= $Page->id_barang->headerCellClass() ?>"><span id="elh_pemesanan_id_barang" class="pemesanan_id_barang"><?= $Page->id_barang->caption() ?></span></th>
<?php } ?>
<?php if ($Page->jumlah_pesanan->Visible) { // jumlah_pesanan ?>
        <th class="<?= $Page->jumlah_pesanan->headerCellClass() ?>"><span id="elh_pemesanan_jumlah_pesanan" class="pemesanan_jumlah_pesanan"><?= $Page->jumlah_pesanan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->lead_time->Visible) { // lead_time ?>
        <th class="<?= $Page->lead_time->headerCellClass() ?>"><span id="elh_pemesanan_lead_time" class="pemesanan_lead_time"><?= $Page->lead_time->caption() ?></span></th>
<?php } ?>
<?php if ($Page->pakai->Visible) { // pakai ?>
        <th class="<?= $Page->pakai->headerCellClass() ?>"><span id="elh_pemesanan_pakai" class="pemesanan_pakai"><?= $Page->pakai->caption() ?></span></th>
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
<?php if ($Page->id_pesanan->Visible) { // id_pesanan ?>
        <td <?= $Page->id_pesanan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pemesanan_id_pesanan" class="pemesanan_id_pesanan">
<span<?= $Page->id_pesanan->viewAttributes() ?>>
<?= $Page->id_pesanan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nama_pemesan->Visible) { // nama_pemesan ?>
        <td <?= $Page->nama_pemesan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pemesanan_nama_pemesan" class="pemesanan_nama_pemesan">
<span<?= $Page->nama_pemesan->viewAttributes() ?>>
<?= $Page->nama_pemesan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->id_barang->Visible) { // id_barang ?>
        <td <?= $Page->id_barang->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pemesanan_id_barang" class="pemesanan_id_barang">
<span<?= $Page->id_barang->viewAttributes() ?>>
<?= $Page->id_barang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->jumlah_pesanan->Visible) { // jumlah_pesanan ?>
        <td <?= $Page->jumlah_pesanan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pemesanan_jumlah_pesanan" class="pemesanan_jumlah_pesanan">
<span<?= $Page->jumlah_pesanan->viewAttributes() ?>>
<?= $Page->jumlah_pesanan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->lead_time->Visible) { // lead_time ?>
        <td <?= $Page->lead_time->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pemesanan_lead_time" class="pemesanan_lead_time">
<span<?= $Page->lead_time->viewAttributes() ?>>
<?= $Page->lead_time->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->pakai->Visible) { // pakai ?>
        <td <?= $Page->pakai->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pemesanan_pakai" class="pemesanan_pakai">
<span<?= $Page->pakai->viewAttributes() ?>>
<?= $Page->pakai->getViewValue() ?></span>
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
