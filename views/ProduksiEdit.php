<?php

namespace PHPMaker2021\eoq;

// Page object
$ProduksiEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fproduksiedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fproduksiedit = currentForm = new ew.Form("fproduksiedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "produksi")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.produksi)
        ew.vars.tables.produksi = currentTable;
    fproduksiedit.addFields([
        ["id_produksi", [fields.id_produksi.visible && fields.id_produksi.required ? ew.Validators.required(fields.id_produksi.caption) : null], fields.id_produksi.isInvalid],
        ["id_barang", [fields.id_barang.visible && fields.id_barang.required ? ew.Validators.required(fields.id_barang.caption) : null, ew.Validators.integer], fields.id_barang.isInvalid],
        ["jumlah_produksi", [fields.jumlah_produksi.visible && fields.jumlah_produksi.required ? ew.Validators.required(fields.jumlah_produksi.caption) : null, ew.Validators.integer], fields.jumlah_produksi.isInvalid],
        ["date", [fields.date.visible && fields.date.required ? ew.Validators.required(fields.date.caption) : null, ew.Validators.datetime(0)], fields.date.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fproduksiedit,
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
    fproduksiedit.validate = function () {
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
    fproduksiedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fproduksiedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fproduksiedit.lists.id_barang = <?= $Page->id_barang->toClientList($Page) ?>;
    loadjs.done("fproduksiedit");
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
<form name="fproduksiedit" id="fproduksiedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="produksi">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id_produksi->Visible) { // id_produksi ?>
    <div id="r_id_produksi" class="form-group row">
        <label id="elh_produksi_id_produksi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id_produksi->caption() ?><?= $Page->id_produksi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id_produksi->cellAttributes() ?>>
<span id="el_produksi_id_produksi">
<span<?= $Page->id_produksi->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id_produksi->getDisplayValue($Page->id_produksi->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="produksi" data-field="x_id_produksi" data-hidden="1" name="x_id_produksi" id="x_id_produksi" value="<?= HtmlEncode($Page->id_produksi->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->id_barang->Visible) { // id_barang ?>
    <div id="r_id_barang" class="form-group row">
        <label id="elh_produksi_id_barang" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id_barang->caption() ?><?= $Page->id_barang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id_barang->cellAttributes() ?>>
<span id="el_produksi_id_barang">
<?php
$onchange = $Page->id_barang->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$Page->id_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x_id_barang" class="ew-auto-suggest">
    <input type="<?= $Page->id_barang->getInputTextType() ?>" class="form-control" name="sv_x_id_barang" id="sv_x_id_barang" value="<?= RemoveHtml($Page->id_barang->EditValue) ?>" size="30" placeholder="<?= HtmlEncode($Page->id_barang->getPlaceHolder()) ?>" data-placeholder="<?= HtmlEncode($Page->id_barang->getPlaceHolder()) ?>"<?= $Page->id_barang->editAttributes() ?> aria-describedby="x_id_barang_help">
</span>
<input type="hidden" is="selection-list" class="form-control" data-table="produksi" data-field="x_id_barang" data-input="sv_x_id_barang" data-value-separator="<?= $Page->id_barang->displayValueSeparatorAttribute() ?>" name="x_id_barang" id="x_id_barang" value="<?= HtmlEncode($Page->id_barang->CurrentValue) ?>"<?= $onchange ?>>
<?= $Page->id_barang->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->id_barang->getErrorMessage() ?></div>
<script>
loadjs.ready(["fproduksiedit"], function() {
    fproduksiedit.createAutoSuggest(Object.assign({"id":"x_id_barang","forceSelect":false}, ew.vars.tables.produksi.fields.id_barang.autoSuggestOptions));
});
</script>
<?= $Page->id_barang->Lookup->getParamTag($Page, "p_x_id_barang") ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jumlah_produksi->Visible) { // jumlah_produksi ?>
    <div id="r_jumlah_produksi" class="form-group row">
        <label id="elh_produksi_jumlah_produksi" for="x_jumlah_produksi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jumlah_produksi->caption() ?><?= $Page->jumlah_produksi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->jumlah_produksi->cellAttributes() ?>>
<span id="el_produksi_jumlah_produksi">
<input type="<?= $Page->jumlah_produksi->getInputTextType() ?>" data-table="produksi" data-field="x_jumlah_produksi" name="x_jumlah_produksi" id="x_jumlah_produksi" size="30" placeholder="<?= HtmlEncode($Page->jumlah_produksi->getPlaceHolder()) ?>" value="<?= $Page->jumlah_produksi->EditValue ?>"<?= $Page->jumlah_produksi->editAttributes() ?> aria-describedby="x_jumlah_produksi_help">
<?= $Page->jumlah_produksi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->jumlah_produksi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->date->Visible) { // date ?>
    <div id="r_date" class="form-group row">
        <label id="elh_produksi_date" for="x_date" class="<?= $Page->LeftColumnClass ?>"><?= $Page->date->caption() ?><?= $Page->date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->date->cellAttributes() ?>>
<span id="el_produksi_date">
<input type="<?= $Page->date->getInputTextType() ?>" data-table="produksi" data-field="x_date" name="x_date" id="x_date" placeholder="<?= HtmlEncode($Page->date->getPlaceHolder()) ?>" value="<?= $Page->date->EditValue ?>"<?= $Page->date->editAttributes() ?> aria-describedby="x_date_help">
<?= $Page->date->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->date->getErrorMessage() ?></div>
<?php if (!$Page->date->ReadOnly && !$Page->date->Disabled && !isset($Page->date->EditAttrs["readonly"]) && !isset($Page->date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fproduksiedit", "datetimepicker"], function() {
    ew.createDateTimePicker("fproduksiedit", "x_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
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
    ew.addEventHandlers("produksi");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
