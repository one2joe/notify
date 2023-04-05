<?php

namespace PHPMaker2022\project8;

/**
 * Pager class
 */
class Pager
{
    public $NextButton;
    public $FirstButton;
    public $PrevButton;
    public $LastButton;
    public $PageSize;
    public $FromIndex;
    public $ToIndex;
    public $RecordCount;
    public $Range;
    public $Visible = true;
    public $AutoHidePager = true;
    public $AutoHidePageSizeSelector = true;
    public $UsePageSizeSelector = true;
    public $PageSizes;
    public $ItemPhraseId = "Record";
    public $TableVar;
    public $PageNumberName;
    public $PagePhraseId = "Page";
    private $PageSizeAll = false; // Handle page size = -1 (ALL)
    public static $FormatIntegerFunc = PROJECT_NAMESPACE . "FormatInteger";

    // Constructor
    public function __construct($tableVar, $fromIndex, $pageSize, $recordCount, $pageSizes = "", $range = 10, $autoHidePager = null, $autoHidePageSizeSelector = null, $usePageSizeSelector = null)
    {
        $this->TableVar = $tableVar;
        $this->AutoHidePager = $autoHidePager === null ? Config("AUTO_HIDE_PAGER") : $autoHidePager;
        $this->AutoHidePageSizeSelector = $autoHidePageSizeSelector === null ? Config("AUTO_HIDE_PAGE_SIZE_SELECTOR") : $autoHidePageSizeSelector;
        $this->UsePageSizeSelector = $usePageSizeSelector === null ? true : $usePageSizeSelector;
        $this->FromIndex = (int)$fromIndex;
        $this->PageSize = (int)$pageSize;
        $this->RecordCount = (int)$recordCount;
        $this->Range = (int)$range;
        $this->PageSizes = $pageSizes;
        // Handle page size = 0
        if ($this->PageSize == 0) {
            $this->PageSize = $this->RecordCount > 0 ? $this->RecordCount : 10;
        }
        // Handle page size = -1 (ALL)
        if ($this->PageSize == -1) {
            $this->PageSizeAll = true;
            $this->PageSize = $this->RecordCount > 0 ? $this->RecordCount : 10;
        }
        $this->PageNumberName = Config("TABLE_PAGE_NO");
    }

    // Is visible
    public function isVisible()
    {
        return $this->RecordCount > 0 && $this->Visible;
    }

    // Render
    public function render()
    {
        global $Language;
        $html = "";
        if ($this->Visible && $this->RecordCount > 0) {
            $formatInteger = self::$FormatIntegerFunc;
            // Do not show record numbers for View/Edit page
            if ($this->PagePhraseId !== "Record") {
                $html .= <<<RECORD
                    <div class="ew-pager ew-rec">
                        <span>{$Language->phrase($this->ItemPhraseId)} {$formatInteger($this->FromIndex)} {$Language->phrase("To")} {$formatInteger($this->ToIndex)} {$Language->phrase("Of")} {$formatInteger($this->RecordCount)}</span>
                    </div>
                    RECORD;
            }
            // Page size selector
            if ($this->UsePageSizeSelector && !empty($this->PageSizes) && !($this->AutoHidePageSizeSelector && $this->RecordCount <= $this->PageSize)) {
                if (CurrentPage()->UseTokenInUrl) {
                    $hiddenTag = '<input type="hidden" name="t" value="' . $this->TableVar . '">';
                } else {
                    $hiddenTag = "";
                }
                $pageSizes = explode(",", $this->PageSizes);
                $optionsHtml = "";
                foreach ($pageSizes as $pageSize) {
                    if (intval($pageSize) > 0) {
                        $optionsHtml .= '<option value="' . $pageSize . '"' . ($this->PageSize == $pageSize ? ' selected' : '') . '>' . $formatInteger($pageSize) . '</option>';
                    } else {
                        $optionsHtml .= '<option value="ALL"' . ($this->PageSizeAll ? ' selected' : '') . '>' . $Language->phrase("AllRecords") . '</option>';
                    }
                };
                $tableRecPerPage = Config("TABLE_REC_PER_PAGE");
                $html .= <<<SELECTOR
                    <div class="ew-pager">{$hiddenTag}
                    <select name="{$tableRecPerPage}" class="form-select form-select-sm ew-tooltip" title="{$Language->phrase("RecordsPerPage")}" onchange="this.form.submit();">
                    {$optionsHtml}
                    </select>
                    </div>
                    SELECTOR;
            }
        }
        return $html;
    }
}
