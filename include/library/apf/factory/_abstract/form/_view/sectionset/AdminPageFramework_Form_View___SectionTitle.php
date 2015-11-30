<?php
class AmazonAutoLinks_AdminPageFramework_Form_View___SectionTitle extends AmazonAutoLinks_AdminPageFramework_Form_View___Section_Base {
    public $aArguments = array('title' => null, 'tag' => null, 'section_index' => null, 'sectionset' => array(),);
    public $aFieldsets = array();
    public $aSavedData = array();
    public $aFieldErrors = array();
    public $aFieldTypeDefinitions = array();
    public $oMsg;
    public $aCallbacks = array('fieldset_output', 'is_fieldset_visible' => null,);
    public function __construct() {
        $_aParameters = func_get_args() + array($this->aArguments, $this->aFieldsets, $this->aSavedData, $this->aFieldErrors, $this->aFieldTypeDefinitions, $this->oMsg, $this->aCallbacks);
        $this->aArguments = $_aParameters[0] + $this->aArguments;
        $this->aFieldsets = $_aParameters[1];
        $this->aSavedData = $_aParameters[2];
        $this->aFieldErrors = $_aParameters[3];
        $this->aFieldTypeDefinitions = $_aParameters[4];
        $this->oMsg = $_aParameters[5];
        $this->aCallbacks = $_aParameters[6];
    }
    public function get() {
        $_sTitle = $this->_getSectionTitle($this->aArguments['title'], $this->aArguments['tag'], $this->aFieldsets, $this->aArguments['section_index'], $this->aFieldTypeDefinitions);
        return $_sTitle;
    }
    private function _getToolTip() {
        $_aSectionset = $this->aArguments['sectionset'];
        $_sSectionTitleTagID = str_replace('|', '_', $_aSectionset['_section_path']) . '_' . $this->aArguments['section_index'];
        $_oToolTip = new AmazonAutoLinks_AdminPageFramework_Form_View___ToolTip($_aSectionset['tip'], $_sSectionTitleTagID);
        return $_oToolTip->get();
    }
    protected function _getSectionTitle($sTitle, $sTag, $aFieldsets, $iSectionIndex = null, $aFieldTypeDefinitions = array(), $aCollapsible = array()) {
        $_aSectionTitleField = $this->_getSectionTitleField($aFieldsets, $iSectionIndex, $aFieldTypeDefinitions);
        return $_aSectionTitleField ? $this->getFieldsetOutput($_aSectionTitleField) : "<{$sTag}>" . $this->_getCollapseButton($aCollapsible) . $sTitle . $this->_getToolTip() . "</{$sTag}>";
    }
    private function _getCollapseButton($aCollapsible) {
        $_sExpand = esc_attr($this->oMsg->get('click_to_expand'));
        $_sCollapse = esc_attr($this->oMsg->get('click_to_collapse'));
        return $this->getAOrB('button' === $this->getElement($aCollapsible, 'type', 'box'), "<span class='amazon-auto-links-collapsible-button amazon-auto-links-collapsible-button-expand' title='{$_sExpand}'>&#9658;</span>" . "<span class='amazon-auto-links-collapsible-button amazon-auto-links-collapsible-button-collapse' title='{$_sCollapse}'>&#9660;</span>", '');
    }
    private function _getSectionTitleField(array $aFieldsetsets, $iSectionIndex, $aFieldTypeDefinitions) {
        foreach ($aFieldsetsets as $_aFieldsetset) {
            if ('section_title' !== $_aFieldsetset['type']) {
                continue;
            }
            $_oFieldsetOutputFormatter = new AmazonAutoLinks_AdminPageFramework_Form_Model___Format_FieldsetOutput($_aFieldsetset, $iSectionIndex, $aFieldTypeDefinitions);
            return $_oFieldsetOutputFormatter->get();
        }
    }
}