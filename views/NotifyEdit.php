<?php

namespace PHPMaker2022\project8;

// Page object
$NotifyEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { notify: currentTable } });
var currentForm, currentPageID;
var fnotifyedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fnotifyedit = new ew.Form("fnotifyedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fnotifyedit;

    // Add fields
    var fields = currentTable.fields;
    fnotifyedit.addFields([
        ["Notify_ID", [fields.Notify_ID.visible && fields.Notify_ID.required ? ew.Validators.required(fields.Notify_ID.caption) : null], fields.Notify_ID.isInvalid],
        ["_Token", [fields._Token.visible && fields._Token.required ? ew.Validators.required(fields._Token.caption) : null], fields._Token.isInvalid]
    ]);

    // Form_CustomValidate
    fnotifyedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fnotifyedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("fnotifyedit");
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
<form name="fnotifyedit" id="fnotifyedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="notify">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->Notify_ID->Visible) { // Notify_ID ?>
    <div id="r_Notify_ID"<?= $Page->Notify_ID->rowAttributes() ?>>
        <label id="elh_notify_Notify_ID" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Notify_ID->caption() ?><?= $Page->Notify_ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->Notify_ID->cellAttributes() ?>>
<span id="el_notify_Notify_ID">
<span<?= $Page->Notify_ID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->Notify_ID->getDisplayValue($Page->Notify_ID->EditValue))) ?>"></span>
<input type="hidden" data-table="notify" data-field="x_Notify_ID" data-hidden="1" name="x_Notify_ID" id="x_Notify_ID" value="<?= HtmlEncode($Page->Notify_ID->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_Token->Visible) { // Token ?>
    <div id="r__Token"<?= $Page->_Token->rowAttributes() ?>>
        <label id="elh_notify__Token" for="x__Token" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_Token->caption() ?><?= $Page->_Token->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->_Token->cellAttributes() ?>>
<span id="el_notify__Token">
<input type="<?= $Page->_Token->getInputTextType() ?>" name="x__Token" id="x__Token" data-table="notify" data-field="x__Token" value="<?= $Page->_Token->EditValue ?>" size="30" maxlength="60" placeholder="<?= HtmlEncode($Page->_Token->getPlaceHolder()) ?>"<?= $Page->_Token->editAttributes() ?> aria-describedby="x__Token_help">
<?= $Page->_Token->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_Token->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Page->IsModal) { ?>
<div class="row"><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
    </div><!-- /buttons offset -->
</div><!-- /buttons .row -->
<?php } ?>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("notify");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
