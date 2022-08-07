<?php

namespace PHPMaker2021\eoq;

// Page object
$PegawaiEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fpegawaiedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fpegawaiedit = currentForm = new ew.Form("fpegawaiedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "pegawai")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.pegawai)
        ew.vars.tables.pegawai = currentTable;
    fpegawaiedit.addFields([
        ["id_pegawai", [fields.id_pegawai.visible && fields.id_pegawai.required ? ew.Validators.required(fields.id_pegawai.caption) : null], fields.id_pegawai.isInvalid],
        ["_username", [fields._username.visible && fields._username.required ? ew.Validators.required(fields._username.caption) : null], fields._username.isInvalid],
        ["_password", [fields._password.visible && fields._password.required ? ew.Validators.required(fields._password.caption) : null], fields._password.isInvalid],
        ["nama_pegawai", [fields.nama_pegawai.visible && fields.nama_pegawai.required ? ew.Validators.required(fields.nama_pegawai.caption) : null], fields.nama_pegawai.isInvalid],
        ["alamat_pegawai", [fields.alamat_pegawai.visible && fields.alamat_pegawai.required ? ew.Validators.required(fields.alamat_pegawai.caption) : null], fields.alamat_pegawai.isInvalid],
        ["hp_pegawai", [fields.hp_pegawai.visible && fields.hp_pegawai.required ? ew.Validators.required(fields.hp_pegawai.caption) : null], fields.hp_pegawai.isInvalid],
        ["id_bagian", [fields.id_bagian.visible && fields.id_bagian.required ? ew.Validators.required(fields.id_bagian.caption) : null], fields.id_bagian.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fpegawaiedit,
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
    fpegawaiedit.validate = function () {
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
    fpegawaiedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fpegawaiedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fpegawaiedit.lists.id_bagian = <?= $Page->id_bagian->toClientList($Page) ?>;
    loadjs.done("fpegawaiedit");
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
<form name="fpegawaiedit" id="fpegawaiedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="pegawai">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id_pegawai->Visible) { // id_pegawai ?>
    <div id="r_id_pegawai" class="form-group row">
        <label id="elh_pegawai_id_pegawai" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id_pegawai->caption() ?><?= $Page->id_pegawai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id_pegawai->cellAttributes() ?>>
<span id="el_pegawai_id_pegawai">
<span<?= $Page->id_pegawai->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id_pegawai->getDisplayValue($Page->id_pegawai->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="pegawai" data-field="x_id_pegawai" data-hidden="1" name="x_id_pegawai" id="x_id_pegawai" value="<?= HtmlEncode($Page->id_pegawai->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_username->Visible) { // username ?>
    <div id="r__username" class="form-group row">
        <label id="elh_pegawai__username" for="x__username" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_username->caption() ?><?= $Page->_username->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->_username->cellAttributes() ?>>
<span id="el_pegawai__username">
<input type="<?= $Page->_username->getInputTextType() ?>" data-table="pegawai" data-field="x__username" name="x__username" id="x__username" size="30" maxlength="32" placeholder="<?= HtmlEncode($Page->_username->getPlaceHolder()) ?>" value="<?= $Page->_username->EditValue ?>"<?= $Page->_username->editAttributes() ?> aria-describedby="x__username_help">
<?= $Page->_username->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_username->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_password->Visible) { // password ?>
    <div id="r__password" class="form-group row">
        <label id="elh_pegawai__password" for="x__password" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_password->caption() ?><?= $Page->_password->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->_password->cellAttributes() ?>>
<span id="el_pegawai__password">
<input type="<?= $Page->_password->getInputTextType() ?>" data-table="pegawai" data-field="x__password" name="x__password" id="x__password" size="30" maxlength="16" placeholder="<?= HtmlEncode($Page->_password->getPlaceHolder()) ?>" value="<?= $Page->_password->EditValue ?>"<?= $Page->_password->editAttributes() ?> aria-describedby="x__password_help">
<?= $Page->_password->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_password->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nama_pegawai->Visible) { // nama_pegawai ?>
    <div id="r_nama_pegawai" class="form-group row">
        <label id="elh_pegawai_nama_pegawai" for="x_nama_pegawai" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nama_pegawai->caption() ?><?= $Page->nama_pegawai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nama_pegawai->cellAttributes() ?>>
<span id="el_pegawai_nama_pegawai">
<input type="<?= $Page->nama_pegawai->getInputTextType() ?>" data-table="pegawai" data-field="x_nama_pegawai" name="x_nama_pegawai" id="x_nama_pegawai" size="30" maxlength="32" placeholder="<?= HtmlEncode($Page->nama_pegawai->getPlaceHolder()) ?>" value="<?= $Page->nama_pegawai->EditValue ?>"<?= $Page->nama_pegawai->editAttributes() ?> aria-describedby="x_nama_pegawai_help">
<?= $Page->nama_pegawai->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nama_pegawai->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->alamat_pegawai->Visible) { // alamat_pegawai ?>
    <div id="r_alamat_pegawai" class="form-group row">
        <label id="elh_pegawai_alamat_pegawai" for="x_alamat_pegawai" class="<?= $Page->LeftColumnClass ?>"><?= $Page->alamat_pegawai->caption() ?><?= $Page->alamat_pegawai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->alamat_pegawai->cellAttributes() ?>>
<span id="el_pegawai_alamat_pegawai">
<input type="<?= $Page->alamat_pegawai->getInputTextType() ?>" data-table="pegawai" data-field="x_alamat_pegawai" name="x_alamat_pegawai" id="x_alamat_pegawai" size="30" maxlength="64" placeholder="<?= HtmlEncode($Page->alamat_pegawai->getPlaceHolder()) ?>" value="<?= $Page->alamat_pegawai->EditValue ?>"<?= $Page->alamat_pegawai->editAttributes() ?> aria-describedby="x_alamat_pegawai_help">
<?= $Page->alamat_pegawai->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->alamat_pegawai->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->hp_pegawai->Visible) { // hp_pegawai ?>
    <div id="r_hp_pegawai" class="form-group row">
        <label id="elh_pegawai_hp_pegawai" for="x_hp_pegawai" class="<?= $Page->LeftColumnClass ?>"><?= $Page->hp_pegawai->caption() ?><?= $Page->hp_pegawai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->hp_pegawai->cellAttributes() ?>>
<span id="el_pegawai_hp_pegawai">
<input type="<?= $Page->hp_pegawai->getInputTextType() ?>" data-table="pegawai" data-field="x_hp_pegawai" name="x_hp_pegawai" id="x_hp_pegawai" size="30" maxlength="16" placeholder="<?= HtmlEncode($Page->hp_pegawai->getPlaceHolder()) ?>" value="<?= $Page->hp_pegawai->EditValue ?>"<?= $Page->hp_pegawai->editAttributes() ?> aria-describedby="x_hp_pegawai_help">
<?= $Page->hp_pegawai->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->hp_pegawai->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->id_bagian->Visible) { // id_bagian ?>
    <div id="r_id_bagian" class="form-group row">
        <label id="elh_pegawai_id_bagian" for="x_id_bagian" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id_bagian->caption() ?><?= $Page->id_bagian->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id_bagian->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<span id="el_pegawai_id_bagian">
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id_bagian->getDisplayValue($Page->id_bagian->EditValue))) ?>">
</span>
<?php } else { ?>
<span id="el_pegawai_id_bagian">
    <select
        id="x_id_bagian"
        name="x_id_bagian"
        class="form-control ew-select<?= $Page->id_bagian->isInvalidClass() ?>"
        data-select2-id="pegawai_x_id_bagian"
        data-table="pegawai"
        data-field="x_id_bagian"
        data-value-separator="<?= $Page->id_bagian->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->id_bagian->getPlaceHolder()) ?>"
        <?= $Page->id_bagian->editAttributes() ?>>
        <?= $Page->id_bagian->selectOptionListHtml("x_id_bagian") ?>
    </select>
    <?= $Page->id_bagian->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->id_bagian->getErrorMessage() ?></div>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='pegawai_x_id_bagian']"),
        options = { name: "x_id_bagian", selectId: "pegawai_x_id_bagian", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.data = ew.vars.tables.pegawai.fields.id_bagian.lookupOptions;
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.pegawai.fields.id_bagian.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
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
    ew.addEventHandlers("pegawai");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
