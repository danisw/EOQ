<?php

namespace PHPMaker2021\eoq;

// Page object
$BarangDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fbarangdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fbarangdelete = currentForm = new ew.Form("fbarangdelete", "delete");
    loadjs.done("fbarangdelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.barang) ew.vars.tables.barang = <?= JsonEncode(GetClientVar("tables", "barang")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fbarangdelete" id="fbarangdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="barang">
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
<?php if ($Page->id_barang->Visible) { // id_barang ?>
        <th class="<?= $Page->id_barang->headerCellClass() ?>"><span id="elh_barang_id_barang" class="barang_id_barang"><?= $Page->id_barang->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nama_barang->Visible) { // nama_barang ?>
        <th class="<?= $Page->nama_barang->headerCellClass() ?>"><span id="elh_barang_nama_barang" class="barang_nama_barang"><?= $Page->nama_barang->caption() ?></span></th>
<?php } ?>
<?php if ($Page->harga_barang->Visible) { // harga_barang ?>
        <th class="<?= $Page->harga_barang->headerCellClass() ?>"><span id="elh_barang_harga_barang" class="barang_harga_barang"><?= $Page->harga_barang->caption() ?></span></th>
<?php } ?>
<?php if ($Page->biaya_penyimpanan->Visible) { // biaya_penyimpanan ?>
        <th class="<?= $Page->biaya_penyimpanan->headerCellClass() ?>"><span id="elh_barang_biaya_penyimpanan" class="barang_biaya_penyimpanan"><?= $Page->biaya_penyimpanan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->periode_permintaan->Visible) { // periode_permintaan ?>
        <th class="<?= $Page->periode_permintaan->headerCellClass() ?>"><span id="elh_barang_periode_permintaan" class="barang_periode_permintaan"><?= $Page->periode_permintaan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->satuan->Visible) { // satuan ?>
        <th class="<?= $Page->satuan->headerCellClass() ?>"><span id="elh_barang_satuan" class="barang_satuan"><?= $Page->satuan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->konversi->Visible) { // konversi ?>
        <th class="<?= $Page->konversi->headerCellClass() ?>"><span id="elh_barang_konversi" class="barang_konversi"><?= $Page->konversi->caption() ?></span></th>
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
<?php if ($Page->id_barang->Visible) { // id_barang ?>
        <td <?= $Page->id_barang->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_barang_id_barang" class="barang_id_barang">
<span<?= $Page->id_barang->viewAttributes() ?>>
<?= $Page->id_barang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nama_barang->Visible) { // nama_barang ?>
        <td <?= $Page->nama_barang->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_barang_nama_barang" class="barang_nama_barang">
<span<?= $Page->nama_barang->viewAttributes() ?>>
<?= $Page->nama_barang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->harga_barang->Visible) { // harga_barang ?>
        <td <?= $Page->harga_barang->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_barang_harga_barang" class="barang_harga_barang">
<span<?= $Page->harga_barang->viewAttributes() ?>>
<?= $Page->harga_barang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->biaya_penyimpanan->Visible) { // biaya_penyimpanan ?>
        <td <?= $Page->biaya_penyimpanan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_barang_biaya_penyimpanan" class="barang_biaya_penyimpanan">
<span<?= $Page->biaya_penyimpanan->viewAttributes() ?>>
<?= $Page->biaya_penyimpanan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->periode_permintaan->Visible) { // periode_permintaan ?>
        <td <?= $Page->periode_permintaan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_barang_periode_permintaan" class="barang_periode_permintaan">
<span<?= $Page->periode_permintaan->viewAttributes() ?>>
<?= $Page->periode_permintaan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->satuan->Visible) { // satuan ?>
        <td <?= $Page->satuan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_barang_satuan" class="barang_satuan">
<span<?= $Page->satuan->viewAttributes() ?>>
<?= $Page->satuan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->konversi->Visible) { // konversi ?>
        <td <?= $Page->konversi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_barang_konversi" class="barang_konversi">
<span<?= $Page->konversi->viewAttributes() ?>>
<?= $Page->konversi->getViewValue() ?></span>
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
