<?php

namespace PHPMaker2022\project8;

// Page object
$NotifyDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { notify: currentTable } });
var currentForm, currentPageID;
var fnotifydelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fnotifydelete = new ew.Form("fnotifydelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fnotifydelete;
    loadjs.done("fnotifydelete");
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
<form name="fnotifydelete" id="fnotifydelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="notify">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table table-bordered table-hover table-sm ew-table">
    <thead>
    <tr class="ew-table-header">
<?php if ($Page->Notify_ID->Visible) { // Notify_ID ?>
        <th class="<?= $Page->Notify_ID->headerCellClass() ?>"><span id="elh_notify_Notify_ID" class="notify_Notify_ID"><?= $Page->Notify_ID->caption() ?></span></th>
<?php } ?>
<?php if ($Page->_Token->Visible) { // Token ?>
        <th class="<?= $Page->_Token->headerCellClass() ?>"><span id="elh_notify__Token" class="notify__Token"><?= $Page->_Token->caption() ?></span></th>
<?php } ?>
    </tr>
    </thead>
    <tbody>
<?php
$Page->RecordCount = 0;
$i = 0;
while (!$Page->Recordset->EOF) {
    $Page->RecordCount++;
    $Page->RowCount++;

    // Set row properties
    $Page->resetAttributes();
    $Page->RowType = ROWTYPE_VIEW; // View

    // Get the field contents
    $Page->loadRowValues($Page->Recordset);

    // Render row
    $Page->renderRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php if ($Page->Notify_ID->Visible) { // Notify_ID ?>
        <td<?= $Page->Notify_ID->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_notify_Notify_ID" class="el_notify_Notify_ID">
<span<?= $Page->Notify_ID->viewAttributes() ?>>
<?= $Page->Notify_ID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->_Token->Visible) { // Token ?>
        <td<?= $Page->_Token->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_notify__Token" class="el_notify__Token">
<span<?= $Page->_Token->viewAttributes() ?>>
<?= $Page->_Token->getViewValue() ?></span>
</span>
</td>
<?php } ?>
    </tr>
<?php
    $Page->Recordset->moveNext();
}
$Page->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
