<?php

namespace PHPMaker2021\eoq;

// Page object
$BagianEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fbagianedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fbagianedit = currentForm = new ew.Form("fbagianedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "bagian")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.bagian)
        ew.vars.tables.bagian = currentTable;
    fbagianedit.addFields([
        ["id_bagian", [fields.id_bagian.visible && fields.id_bagian.required ? ew.Validators.required(fields.id_bagian.caption) : null], fields.id_bagian.isInvalid],
        ["nama_bagian", [fields.nama_bagian.visible && fields.nama_bagian.required ? ew.Validators.required(fields.nama_bagian.caption) : null], fields.nama_bagian.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fbagianedit,
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
    fbagianedit.validate = function () {
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
    fbagianedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fbagianedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fbagianedit");
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
<form name="fbagianedit" id="fbagianedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="bagian">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id_bagian->Visible) { // id_bagian ?>
    <div id="r_id_bagian" class="form-group row">
        <label id="elh_bagian_id_bagian" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id_bagian->caption() ?><?= $Page->id_bagian->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id_bagian->cellAttributes() ?>>
<span id="el_bagian_id_bagian">
<span<?= $Page->id_bagian->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id_bagian->getDisplayValue($Page->id_bagian->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="bagian" data-field="x_id_bagian" data-hidden="1" name="x_id_bagian" id="x_id_bagian" value="<?= HtmlEncode($Page->id_bagian->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nama_bagian->Visible) { // nama_bagian ?>
    <div id="r_nama_bagian" class="form-group row">
        <label id="elh_bagian_nama_bagian" for="x_nama_bagian" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nama_bagian->caption() ?><?= $Page->nama_bagian->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nama_bagian->cellAttributes() ?>>
<span id="el_bagian_nama_bagian">
<input type="<?= $Page->nama_bagian->getInputTextType() ?>" data-table="bagian" data-field="x_nama_bagian" name="x_nama_bagian" id="x_nama_bagian" size="30" maxlength="32" placeholder="<?= HtmlEncode($Page->nama_bagian->getPlaceHolder()) ?>" value="<?= $Page->nama_bagian->EditValue ?>"<?= $Page->nama_bagian->editAttributes() ?> aria-describedby="x_nama_bagian_help">
<?= $Page->nama_bagian->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nama_bagian->getErrorMessage() ?></div>
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
    ew.addEventHandlers("bagian");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
