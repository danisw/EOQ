<?php

namespace PHPMaker2021\eoq;

// Page object
$PemesananAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var fpemesananadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fpemesananadd = currentForm = new ew.Form("fpemesananadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "pemesanan")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.pemesanan)
        ew.vars.tables.pemesanan = currentTable;
    fpemesananadd.addFields([
        ["nama_pemesan", [fields.nama_pemesan.visible && fields.nama_pemesan.required ? ew.Validators.required(fields.nama_pemesan.caption) : null], fields.nama_pemesan.isInvalid],
        ["id_barang", [fields.id_barang.visible && fields.id_barang.required ? ew.Validators.required(fields.id_barang.caption) : null, ew.Validators.integer], fields.id_barang.isInvalid],
        ["jumlah_pesanan", [fields.jumlah_pesanan.visible && fields.jumlah_pesanan.required ? ew.Validators.required(fields.jumlah_pesanan.caption) : null], fields.jumlah_pesanan.isInvalid],
        ["lead_time", [fields.lead_time.visible && fields.lead_time.required ? ew.Validators.required(fields.lead_time.caption) : null, ew.Validators.integer], fields.lead_time.isInvalid],
        ["pakai", [fields.pakai.visible && fields.pakai.required ? ew.Validators.required(fields.pakai.caption) : null], fields.pakai.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fpemesananadd,
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
    fpemesananadd.validate = function () {
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
    fpemesananadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fpemesananadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fpemesananadd");
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
<form name="fpemesananadd" id="fpemesananadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="pemesanan">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->nama_pemesan->Visible) { // nama_pemesan ?>
    <div id="r_nama_pemesan" class="form-group row">
        <label id="elh_pemesanan_nama_pemesan" for="x_nama_pemesan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nama_pemesan->caption() ?><?= $Page->nama_pemesan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nama_pemesan->cellAttributes() ?>>
<span id="el_pemesanan_nama_pemesan">
<input type="<?= $Page->nama_pemesan->getInputTextType() ?>" data-table="pemesanan" data-field="x_nama_pemesan" name="x_nama_pemesan" id="x_nama_pemesan" size="30" maxlength="32" placeholder="<?= HtmlEncode($Page->nama_pemesan->getPlaceHolder()) ?>" value="<?= $Page->nama_pemesan->EditValue ?>"<?= $Page->nama_pemesan->editAttributes() ?> aria-describedby="x_nama_pemesan_help">
<?= $Page->nama_pemesan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nama_pemesan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->id_barang->Visible) { // id_barang ?>
    <div id="r_id_barang" class="form-group row">
        <label id="elh_pemesanan_id_barang" for="x_id_barang" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id_barang->caption() ?><?= $Page->id_barang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id_barang->cellAttributes() ?>>
<span id="el_pemesanan_id_barang">
<input type="<?= $Page->id_barang->getInputTextType() ?>" data-table="pemesanan" data-field="x_id_barang" name="x_id_barang" id="x_id_barang" size="30" placeholder="<?= HtmlEncode($Page->id_barang->getPlaceHolder()) ?>" value="<?= $Page->id_barang->EditValue ?>"<?= $Page->id_barang->editAttributes() ?> aria-describedby="x_id_barang_help">
<?= $Page->id_barang->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->id_barang->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jumlah_pesanan->Visible) { // jumlah_pesanan ?>
    <div id="r_jumlah_pesanan" class="form-group row">
        <label id="elh_pemesanan_jumlah_pesanan" for="x_jumlah_pesanan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jumlah_pesanan->caption() ?><?= $Page->jumlah_pesanan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->jumlah_pesanan->cellAttributes() ?>>
<span id="el_pemesanan_jumlah_pesanan">
<input type="<?= $Page->jumlah_pesanan->getInputTextType() ?>" data-table="pemesanan" data-field="x_jumlah_pesanan" name="x_jumlah_pesanan" id="x_jumlah_pesanan" size="30" maxlength="16" placeholder="<?= HtmlEncode($Page->jumlah_pesanan->getPlaceHolder()) ?>" value="<?= $Page->jumlah_pesanan->EditValue ?>"<?= $Page->jumlah_pesanan->editAttributes() ?> aria-describedby="x_jumlah_pesanan_help">
<?= $Page->jumlah_pesanan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->jumlah_pesanan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->lead_time->Visible) { // lead_time ?>
    <div id="r_lead_time" class="form-group row">
        <label id="elh_pemesanan_lead_time" for="x_lead_time" class="<?= $Page->LeftColumnClass ?>"><?= $Page->lead_time->caption() ?><?= $Page->lead_time->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->lead_time->cellAttributes() ?>>
<span id="el_pemesanan_lead_time">
<input type="<?= $Page->lead_time->getInputTextType() ?>" data-table="pemesanan" data-field="x_lead_time" name="x_lead_time" id="x_lead_time" size="30" placeholder="<?= HtmlEncode($Page->lead_time->getPlaceHolder()) ?>" value="<?= $Page->lead_time->EditValue ?>"<?= $Page->lead_time->editAttributes() ?> aria-describedby="x_lead_time_help">
<?= $Page->lead_time->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->lead_time->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->pakai->Visible) { // pakai ?>
    <div id="r_pakai" class="form-group row">
        <label id="elh_pemesanan_pakai" for="x_pakai" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pakai->caption() ?><?= $Page->pakai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->pakai->cellAttributes() ?>>
<span id="el_pemesanan_pakai">
<input type="<?= $Page->pakai->getInputTextType() ?>" data-table="pemesanan" data-field="x_pakai" name="x_pakai" id="x_pakai" size="30" maxlength="8" placeholder="<?= HtmlEncode($Page->pakai->getPlaceHolder()) ?>" value="<?= $Page->pakai->EditValue ?>"<?= $Page->pakai->editAttributes() ?> aria-describedby="x_pakai_help">
<?= $Page->pakai->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->pakai->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Page->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("AddBtn") ?></button>
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
    ew.addEventHandlers("pemesanan");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
