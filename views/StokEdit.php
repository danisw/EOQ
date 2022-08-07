<?php

namespace PHPMaker2021\eoq;

// Page object
$StokEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fstokedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fstokedit = currentForm = new ew.Form("fstokedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "stok")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.stok)
        ew.vars.tables.stok = currentTable;
    fstokedit.addFields([
        ["id_barang", [fields.id_barang.visible && fields.id_barang.required ? ew.Validators.required(fields.id_barang.caption) : null, ew.Validators.integer], fields.id_barang.isInvalid],
        ["curret_qty", [fields.curret_qty.visible && fields.curret_qty.required ? ew.Validators.required(fields.curret_qty.caption) : null, ew.Validators.integer], fields.curret_qty.isInvalid],
        ["last_update", [fields.last_update.visible && fields.last_update.required ? ew.Validators.required(fields.last_update.caption) : null, ew.Validators.datetime(0)], fields.last_update.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fstokedit,
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
    fstokedit.validate = function () {
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
    fstokedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fstokedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fstokedit");
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
<form name="fstokedit" id="fstokedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="stok">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id_barang->Visible) { // id_barang ?>
    <div id="r_id_barang" class="form-group row">
        <label id="elh_stok_id_barang" for="x_id_barang" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id_barang->caption() ?><?= $Page->id_barang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id_barang->cellAttributes() ?>>
<input type="<?= $Page->id_barang->getInputTextType() ?>" data-table="stok" data-field="x_id_barang" name="x_id_barang" id="x_id_barang" size="30" placeholder="<?= HtmlEncode($Page->id_barang->getPlaceHolder()) ?>" value="<?= $Page->id_barang->EditValue ?>"<?= $Page->id_barang->editAttributes() ?> aria-describedby="x_id_barang_help">
<?= $Page->id_barang->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->id_barang->getErrorMessage() ?></div>
<input type="hidden" data-table="stok" data-field="x_id_barang" data-hidden="1" name="o_id_barang" id="o_id_barang" value="<?= HtmlEncode($Page->id_barang->OldValue ?? $Page->id_barang->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->curret_qty->Visible) { // curret_qty ?>
    <div id="r_curret_qty" class="form-group row">
        <label id="elh_stok_curret_qty" for="x_curret_qty" class="<?= $Page->LeftColumnClass ?>"><?= $Page->curret_qty->caption() ?><?= $Page->curret_qty->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->curret_qty->cellAttributes() ?>>
<span id="el_stok_curret_qty">
<input type="<?= $Page->curret_qty->getInputTextType() ?>" data-table="stok" data-field="x_curret_qty" name="x_curret_qty" id="x_curret_qty" size="30" placeholder="<?= HtmlEncode($Page->curret_qty->getPlaceHolder()) ?>" value="<?= $Page->curret_qty->EditValue ?>"<?= $Page->curret_qty->editAttributes() ?> aria-describedby="x_curret_qty_help">
<?= $Page->curret_qty->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->curret_qty->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->last_update->Visible) { // last_update ?>
    <div id="r_last_update" class="form-group row">
        <label id="elh_stok_last_update" for="x_last_update" class="<?= $Page->LeftColumnClass ?>"><?= $Page->last_update->caption() ?><?= $Page->last_update->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->last_update->cellAttributes() ?>>
<span id="el_stok_last_update">
<input type="<?= $Page->last_update->getInputTextType() ?>" data-table="stok" data-field="x_last_update" name="x_last_update" id="x_last_update" placeholder="<?= HtmlEncode($Page->last_update->getPlaceHolder()) ?>" value="<?= $Page->last_update->EditValue ?>"<?= $Page->last_update->editAttributes() ?> aria-describedby="x_last_update_help">
<?= $Page->last_update->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->last_update->getErrorMessage() ?></div>
<?php if (!$Page->last_update->ReadOnly && !$Page->last_update->Disabled && !isset($Page->last_update->EditAttrs["readonly"]) && !isset($Page->last_update->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstokedit", "datetimepicker"], function() {
    ew.createDateTimePicker("fstokedit", "x_last_update", {"ignoreReadonly":true,"useCurrent":false,"format":0});
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
    ew.addEventHandlers("stok");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
