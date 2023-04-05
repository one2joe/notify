<?php

namespace PHPMaker2022\project8;

// Page object
$NotifyView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { notify: currentTable } });
var currentForm, currentPageID;
var fnotifyview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fnotifyview = new ew.Form("fnotifyview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fnotifyview;
    loadjs.done("fnotifyview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Page->ExportOptions->render("body") ?>
<?php $Page->OtherOptions->render("body") ?>
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fnotifyview" id="fnotifyview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="notify">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->Notify_ID->Visible) { // Notify_ID ?>
    <tr id="r_Notify_ID"<?= $Page->Notify_ID->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_notify_Notify_ID"><?= $Page->Notify_ID->caption() ?></span></td>
        <td data-name="Notify_ID"<?= $Page->Notify_ID->cellAttributes() ?>>
<span id="el_notify_Notify_ID">
<span<?= $Page->Notify_ID->viewAttributes() ?>>
<?= $Page->Notify_ID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->_Token->Visible) { // Token ?>
    <tr id="r__Token"<?= $Page->_Token->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_notify__Token"><?= $Page->_Token->caption() ?></span></td>
        <td data-name="_Token"<?= $Page->_Token->cellAttributes() ?>>
<span id="el_notify__Token">
<span<?= $Page->_Token->viewAttributes() ?>>
<?= $Page->_Token->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
