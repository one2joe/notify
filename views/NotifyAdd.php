<?php

namespace PHPMaker2022\project8;

// Page object
$NotifyAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { notify: currentTable } });
var currentForm, currentPageID;
var fnotifyadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fnotifyadd = new ew.Form("fnotifyadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fnotifyadd;

    // Add fields
    var fields = currentTable.fields;
    fnotifyadd.addFields([
        ["_Token", [fields._Token.visible && fields._Token.required ? ew.Validators.required(fields._Token.caption) : null], fields._Token.isInvalid]
    ]);

    // Form_CustomValidate
    fnotifyadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fnotifyadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("fnotifyadd");
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
<form name="fnotifyadd" id="fnotifyadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="notify">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
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
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("AddBtn") ?></button>
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
