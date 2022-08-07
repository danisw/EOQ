<?php

namespace PHPMaker2021\eoq;

// Page object
$BarangEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fbarangedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fbarangedit = currentForm = new ew.Form("fbarangedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "barang")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.barang)
        ew.vars.tables.barang = currentTable;
    fbarangedit.addFields([
        ["id_barang", [fields.id_barang.visible && fields.id_barang.required ? ew.Validators.required(fields.id_barang.caption) : null], fields.id_barang.isInvalid],
        ["nama_barang", [fields.nama_barang.visible && fields.nama_barang.required ? ew.Validators.required(fields.nama_barang.caption) : null], fields.nama_barang.isInvalid],
        ["harga_barang", [fields.harga_barang.visible && fields.harga_barang.required ? ew.Validators.required(fields.harga_barang.caption) : null], fields.harga_barang.isInvalid],
        ["biaya_penyimpanan", [fields.biaya_penyimpanan.visible && fields.biaya_penyimpanan.required ? ew.Validators.required(fields.biaya_penyimpanan.caption) : null], fields.biaya_penyimpanan.isInvalid],
        ["periode_permintaan", [fields.periode_permintaan.visible && fields.periode_permintaan.required ? ew.Validators.required(fields.periode_permintaan.caption) : null], fields.periode_permintaan.isInvalid],
        ["satuan", [fields.satuan.visible && fields.satuan.required ? ew.Validators.required(fields.satuan.caption) : null], fields.satuan.isInvalid],
        ["konversi", [fields.konversi.visible && fields.konversi.required ? ew.Validators.required(fields.konversi.caption) : null], fields.konversi.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fbarangedit,
            fobj = f.getForm(),
            $fobj = $(fobj),
            $k = $fobj.find("#" + f.formKeyCountName), // Get key_count
            rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1,
            startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
        for (var i = startcnt; i <= rowcnt; i++) {
            var rowIndex = ($k[0]) ? String(i) : "";
            f.setInvalid(rowIndex);
        }
    });

    // Validate form
    fbarangedit.validate = function () {
        if (!this.validateRequired)
            return true; // Ignore validation
        var fobj = this.getForm(),
            $fobj = $(fobj);
        if ($fobj.find("#confirm").val() == "confirm")
            return true;
        var addcnt = 0,
            $k = $fobj.find("#" + this.formKeyCountName), // Get key_count
            rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1,
            startcnt = (rowcnt == 0) ? 0 : 1, // Check rowcnt == 0 => Inline-Add
            gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
        for (var i = startcnt; i <= rowcnt; i++) {
            var rowIndex = ($k[0]) ? String(i) : "";
            $fobj.data("rowindex", rowIndex);

            // Validate fields
            if (!this.validateFields(rowIndex))
                return false;

            // Call Form_CustomValidate event
            if (!this.customValidate(fobj)) {
                this.focus();
                return false;
            }
        }

        // Process detail forms
        var dfs = $fobj.find("input[name='detailpage']").get();
        for (var i = 0; i < dfs.length; i++) {
            var df = dfs[i],
                val = df.value,
                frm = ew.forms.get(val);
            if (val && frm && !frm.validate())
                return false;
        }
        return true;
    }

    // Form_CustomValidate
    fbarangedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fbarangedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fbarangedit");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fbarangedit" id="fbarangedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="barang">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id_barang->Visible) { // id_barang ?>
    <div id="r_id_barang" class="form-group row">
        <label id="elh_barang_id_barang" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id_barang->caption() ?><?= $Page->id_barang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id_barang->cellAttributes() ?>>
<span id="el_barang_id_barang">
<span<?= $Page->id_barang->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id_barang->getDisplayValue($Page->id_barang->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="barang" data-field="x_id_barang" data-hidden="1" name="x_id_barang" id="x_id_barang" value="<?= HtmlEncode($Page->id_barang->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nama_barang->Visible) { // nama_barang ?>
    <div id="r_nama_barang" class="form-group row">
        <label id="elh_barang_nama_barang" for="x_nama_barang" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nama_barang->caption() ?><?= $Page->nama_barang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nama_barang->cellAttributes() ?>>
<span id="el_barang_nama_barang">
<input type="<?= $Page->nama_barang->getInputTextType() ?>" data-table="barang" data-field="x_nama_barang" name="x_nama_barang" id="x_nama_barang" size="30" maxlength="64" placeholder="<?= HtmlEncode($Page->nama_barang->getPlaceHolder()) ?>" value="<?= $Page->nama_barang->EditValue ?>"<?= $Page->nama_barang->editAttributes() ?> aria-describedby="x_nama_barang_help">
<?= $Page->nama_barang->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nama_barang->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->harga_barang->Visible) { // harga_barang ?>
    <div id="r_harga_barang" class="form-group row">
        <label id="elh_barang_harga_barang" for="x_harga_barang" class="<?= $Page->LeftColumnClass ?>"><?= $Page->harga_barang->caption() ?><?= $Page->harga_barang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->harga_barang->cellAttributes() ?>>
<span id="el_barang_harga_barang">
<input type="<?= $Page->harga_barang->getInputTextType() ?>" data-table="barang" data-field="x_harga_barang" name="x_harga_barang" id="x_harga_barang" size="30" maxlength="16" placeholder="<?= HtmlEncode($Page->harga_barang->getPlaceHolder()) ?>" value="<?= $Page->harga_barang->EditValue ?>"<?= $Page->harga_barang->editAttributes() ?> aria-describedby="x_harga_barang_help">
<?= $Page->harga_barang->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->harga_barang->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->biaya_penyimpanan->Visible) { // biaya_penyimpanan ?>
    <div id="r_biaya_penyimpanan" class="form-group row">
        <label id="elh_barang_biaya_penyimpanan" for="x_biaya_penyimpanan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->biaya_penyimpanan->caption() ?><?= $Page->biaya_penyimpanan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->biaya_penyimpanan->cellAttributes() ?>>
<span id="el_barang_biaya_penyimpanan">
<input type="<?= $Page->biaya_penyimpanan->getInputTextType() ?>" data-table="barang" data-field="x_biaya_penyimpanan" name="x_biaya_penyimpanan" id="x_biaya_penyimpanan" size="30" maxlength="16" placeholder="<?= HtmlEncode($Page->biaya_penyimpanan->getPlaceHolder()) ?>" value="<?= $Page->biaya_penyimpanan->EditValue ?>"<?= $Page->biaya_penyimpanan->editAttributes() ?> aria-describedby="x_biaya_penyimpanan_help">
<?= $Page->biaya_penyimpanan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->biaya_penyimpanan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->periode_permintaan->Visible) { // periode_permintaan ?>
    <div id="r_periode_permintaan" class="form-group row">
        <label id="elh_barang_periode_permintaan" for="x_periode_permintaan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->periode_permintaan->caption() ?><?= $Page->periode_permintaan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->periode_permintaan->cellAttributes() ?>>
<span id="el_barang_periode_permintaan">
<input type="<?= $Page->periode_permintaan->getInputTextType() ?>" data-table="barang" data-field="x_periode_permintaan" name="x_periode_permintaan" id="x_periode_permintaan" size="30" maxlength="4" placeholder="<?= HtmlEncode($Page->periode_permintaan->getPlaceHolder()) ?>" value="<?= $Page->periode_permintaan->EditValue ?>"<?= $Page->periode_permintaan->editAttributes() ?> aria-describedby="x_periode_permintaan_help">
<?= $Page->periode_permintaan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->periode_permintaan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->satuan->Visible) { // satuan ?>
    <div id="r_satuan" class="form-group row">
        <label id="elh_barang_satuan" for="x_satuan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->satuan->caption() ?><?= $Page->satuan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->satuan->cellAttributes() ?>>
<span id="el_barang_satuan">
<input type="<?= $Page->satuan->getInputTextType() ?>" data-table="barang" data-field="x_satuan" name="x_satuan" id="x_satuan" size="30" maxlength="16" placeholder="<?= HtmlEncode($Page->satuan->getPlaceHolder()) ?>" value="<?= $Page->satuan->EditValue ?>"<?= $Page->satuan->editAttributes() ?> aria-describedby="x_satuan_help">
<?= $Page->satuan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->satuan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->konversi->Visible) { // konversi ?>
    <div id="r_konversi" class="form-group row">
        <label id="elh_barang_konversi" for="x_konversi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->konversi->caption() ?><?= $Page->konversi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->konversi->cellAttributes() ?>>
<span id="el_barang_konversi">
<input type="<?= $Page->konversi->getInputTextType() ?>" data-table="barang" data-field="x_konversi" name="x_konversi" id="x_konversi" size="30" maxlength="16" placeholder="<?= HtmlEncode($Page->konversi->getPlaceHolder()) ?>" value="<?= $Page->konversi->EditValue ?>"<?= $Page->konversi->editAttributes() ?> aria-describedby="x_konversi_help">
<?= $Page->konversi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->konversi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Page->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
    </div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("barang");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
