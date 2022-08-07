<?php

namespace PHPMaker2021\eoq;

// Page object
$PengambilanEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fpengambilanedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fpengambilanedit = currentForm = new ew.Form("fpengambilanedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "pengambilan")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.pengambilan)
        ew.vars.tables.pengambilan = currentTable;
    fpengambilanedit.addFields([
        ["id_pengambilan", [fields.id_pengambilan.visible && fields.id_pengambilan.required ? ew.Validators.required(fields.id_pengambilan.caption) : null], fields.id_pengambilan.isInvalid],
        ["id_barang", [fields.id_barang.visible && fields.id_barang.required ? ew.Validators.required(fields.id_barang.caption) : null, ew.Validators.integer], fields.id_barang.isInvalid],
        ["jumlah_pengambilan", [fields.jumlah_pengambilan.visible && fields.jumlah_pengambilan.required ? ew.Validators.required(fields.jumlah_pengambilan.caption) : null, ew.Validators.integer], fields.jumlah_pengambilan.isInvalid],
        ["date", [fields.date.visible && fields.date.required ? ew.Validators.required(fields.date.caption) : null, ew.Validators.datetime(0)], fields.date.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fpengambilanedit,
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
    fpengambilanedit.validate = function () {
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
    fpengambilanedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fpengambilanedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fpengambilanedit");
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
<form name="fpengambilanedit" id="fpengambilanedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="pengambilan">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id_pengambilan->Visible) { // id_pengambilan ?>
    <div id="r_id_pengambilan" class="form-group row">
        <label id="elh_pengambilan_id_pengambilan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id_pengambilan->caption() ?><?= $Page->id_pengambilan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id_pengambilan->cellAttributes() ?>>
<span id="el_pengambilan_id_pengambilan">
<span<?= $Page->id_pengambilan->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id_pengambilan->getDisplayValue($Page->id_pengambilan->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="pengambilan" data-field="x_id_pengambilan" data-hidden="1" name="x_id_pengambilan" id="x_id_pengambilan" value="<?= HtmlEncode($Page->id_pengambilan->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->id_barang->Visible) { // id_barang ?>
    <div id="r_id_barang" class="form-group row">
        <label id="elh_pengambilan_id_barang" for="x_id_barang" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id_barang->caption() ?><?= $Page->id_barang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id_barang->cellAttributes() ?>>
<span id="el_pengambilan_id_barang">
<input type="<?= $Page->id_barang->getInputTextType() ?>" data-table="pengambilan" data-field="x_id_barang" name="x_id_barang" id="x_id_barang" size="30" placeholder="<?= HtmlEncode($Page->id_barang->getPlaceHolder()) ?>" value="<?= $Page->id_barang->EditValue ?>"<?= $Page->id_barang->editAttributes() ?> aria-describedby="x_id_barang_help">
<?= $Page->id_barang->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->id_barang->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jumlah_pengambilan->Visible) { // jumlah_pengambilan ?>
    <div id="r_jumlah_pengambilan" class="form-group row">
        <label id="elh_pengambilan_jumlah_pengambilan" for="x_jumlah_pengambilan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jumlah_pengambilan->caption() ?><?= $Page->jumlah_pengambilan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->jumlah_pengambilan->cellAttributes() ?>>
<span id="el_pengambilan_jumlah_pengambilan">
<input type="<?= $Page->jumlah_pengambilan->getInputTextType() ?>" data-table="pengambilan" data-field="x_jumlah_pengambilan" name="x_jumlah_pengambilan" id="x_jumlah_pengambilan" size="30" placeholder="<?= HtmlEncode($Page->jumlah_pengambilan->getPlaceHolder()) ?>" value="<?= $Page->jumlah_pengambilan->EditValue ?>"<?= $Page->jumlah_pengambilan->editAttributes() ?> aria-describedby="x_jumlah_pengambilan_help">
<?= $Page->jumlah_pengambilan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->jumlah_pengambilan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->date->Visible) { // date ?>
    <div id="r_date" class="form-group row">
        <label id="elh_pengambilan_date" for="x_date" class="<?= $Page->LeftColumnClass ?>"><?= $Page->date->caption() ?><?= $Page->date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->date->cellAttributes() ?>>
<span id="el_pengambilan_date">
<input type="<?= $Page->date->getInputTextType() ?>" data-table="pengambilan" data-field="x_date" name="x_date" id="x_date" placeholder="<?= HtmlEncode($Page->date->getPlaceHolder()) ?>" value="<?= $Page->date->EditValue ?>"<?= $Page->date->editAttributes() ?> aria-describedby="x_date_help">
<?= $Page->date->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->date->getErrorMessage() ?></div>
<?php if (!$Page->date->ReadOnly && !$Page->date->Disabled && !isset($Page->date->EditAttrs["readonly"]) && !isset($Page->date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpengambilanedit", "datetimepicker"], function() {
    ew.createDateTimePicker("fpengambilanedit", "x_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
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
    ew.addEventHandlers("pengambilan");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
