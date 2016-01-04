<?php 
/**
	Admin Page Framework v3.7.9b03 by Michael Uno 
	Generated by PHP Class Files Script Generator <https://github.com/michaeluno/PHP-Class-Files-Script-Generator>
	<http://en.michaeluno.jp/amazon-auto-links>
	Copyright (c) 2013-2015, Michael Uno; Licensed under MIT <http://opensource.org/licenses/MIT> */
class AmazonAutoLinks_AdminPageFramework_FieldType_submit extends AmazonAutoLinks_AdminPageFramework_FieldType {
    public $aFieldTypeSlugs = array('submit',);
    protected $aDefaultKeys = array('redirect_url' => null, 'href' => null, 'reset' => null, 'email' => null, 'skip_confirmation' => false, 'attributes' => array('class' => 'button button-primary',),);
    protected function getStyles() {
        return <<<CSSRULES
/* Submit Buttons */
.amazon-auto-links-field input[type='submit'] {
    margin-bottom: 0.5em;
}
CSSRULES;
        
    }
    protected function getField($aField) {
        $aField = $this->_getFormatedFieldArray($aField);
        $_aInputAttributes = $this->_getInputAttributes($aField);
        $_aLabelAttributes = $this->_getLabelAttributes($aField, $_aInputAttributes);
        $_aLabelContainerAttributes = $this->_getLabelContainerAttributes($aField);
        return $aField['before_label'] . "<div " . $this->getAttributes($_aLabelContainerAttributes) . ">" . $this->_getExtraFieldsBeforeLabel($aField) . "<label " . $this->getAttributes($_aLabelAttributes) . ">" . $aField['before_input'] . $this->_getExtraInputFields($aField) . "<input " . $this->getAttributes($_aInputAttributes) . " />" . $aField['after_input'] . "</label>" . "</div>" . $aField['after_label'];
    }
    private function _getFormatedFieldArray(array $aField) {
        $aField['label'] = $aField['label'] ? $aField['label'] : $this->oMsg->get('submit');
        if (isset($aField['attributes']['src'])) {
            $aField['attributes']['src'] = esc_url($this->getResolvedSRC($aField['attributes']['src']));
        }
        return $aField;
    }
    private function _getLabelAttributes(array $aField, array $aInputAttributes) {
        return array('style' => $aField['label_min_width'] ? "min-width:" . $this->sanitizeLength($aField['label_min_width']) . ";" : null, 'for' => $aInputAttributes['id'], 'class' => $aInputAttributes['disabled'] ? 'disabled' : null,);
    }
    private function _getLabelContainerAttributes(array $aField) {
        return array('style' => $aField['label_min_width'] ? "min-width:" . $this->sanitizeLength($aField['label_min_width']) . ";" : null, 'class' => 'amazon-auto-links-input-label-container' . ' amazon-auto-links-input-button-container' . ' amazon-auto-links-input-container',);
    }
    private function _getInputAttributes(array $aField) {
        $_bIsImageButton = isset($aField['attributes']['src']) && filter_var($aField['attributes']['src'], FILTER_VALIDATE_URL);
        $_sValue = $this->_getInputFieldValueFromLabel($aField);
        return array('type' => $_bIsImageButton ? 'image' : 'submit', 'value' => $_sValue,) + $aField['attributes'] + array('title' => $_sValue, 'alt' => $_bIsImageButton ? 'submit' : '',);
    }
    protected function _getExtraFieldsBeforeLabel(&$aField) {
        return '';
    }
    protected function _getExtraInputFields(&$aField) {
        $_aOutput = array();
        $_aOutput[] = $this->getHTMLTag('input', array('type' => 'hidden', 'name' => "__submit[{$aField['input_id']}][input_id]", 'value' => $aField['input_id'],));
        $_aOutput[] = $this->getHTMLTag('input', array('type' => 'hidden', 'name' => "__submit[{$aField['input_id']}][field_id]", 'value' => $aField['field_id'],));
        $_aOutput[] = $this->getHTMLTag('input', array('type' => 'hidden', 'name' => "__submit[{$aField['input_id']}][name]", 'value' => $aField['_input_name_flat'],));
        $_aOutput[] = $this->_getHiddenInput_SectionID($aField);
        $_aOutput[] = $this->_getHiddenInputByKey($aField, 'redirect_url');
        $_aOutput[] = $this->_getHiddenInputByKey($aField, 'href');
        $_aOutput[] = $this->_getHiddenInput_Reset($aField);
        $_aOutput[] = $this->_getHiddenInput_Email($aField);
        return implode(PHP_EOL, array_filter($_aOutput));
    }
    private function _getHiddenInput_SectionID(array $aField) {
        return $this->getHTMLTag('input', array('type' => 'hidden', 'name' => "__submit[{$aField['input_id']}][section_id]", 'value' => isset($aField['section_id']) && '_default' !== $aField['section_id'] ? $aField['section_id'] : '',));
    }
    private function _getHiddenInputByKey(array $aField, $sKey) {
        return isset($aField[$sKey]) ? $this->getHTMLTag('input', array('type' => 'hidden', 'name' => "__submit[{$aField['input_id']}][{$sKey}]", 'value' => $aField[$sKey],)) : '';
    }
    private function _getHiddenInput_Reset(array $aField) {
        if (!$aField['reset']) {
            return '';
        }
        return !$this->_checkConfirmationDisplayed($aField, $aField['_input_name_flat'], 'reset') ? $this->getHTMLTag('input', array('type' => 'hidden', 'name' => "__submit[{$aField['input_id']}][is_reset]", 'value' => '1',)) : $this->getHTMLTag('input', array('type' => 'hidden', 'name' => "__submit[{$aField['input_id']}][reset_key]", 'value' => is_array($aField['reset']) ? implode('|', $aField['reset']) : $aField['reset'],));
    }
    private function _getHiddenInput_Email(array $aField) {
        if (empty($aField['email'])) {
            return '';
        }
        $this->setTransient('apf_em_' . md5($aField['_input_name_flat'] . get_current_user_id()), $aField['email']);
        return !$this->_checkConfirmationDisplayed($aField, $aField['_input_name_flat'], 'email') ? $this->getHTMLTag('input', array('type' => 'hidden', 'name' => "__submit[{$aField['input_id']}][confirming_sending_email]", 'value' => '1',)) : $this->getHTMLTag('input', array('type' => 'hidden', 'name' => "__submit[{$aField['input_id']}][confirmed_sending_email]", 'value' => '1',));
    }
    private function _checkConfirmationDisplayed($aField, $sFlatFieldName, $sType = 'reset') {
        switch ($sType) {
            default:
            case 'reset':
                $_sTransientKey = 'apf_rc_' . md5($sFlatFieldName . get_current_user_id());
            break;
            case 'email':
                $_sTransientKey = 'apf_ec_' . md5($sFlatFieldName . get_current_user_id());
            break;
        }
        $_bConfirmed = false === $this->getTransient($_sTransientKey) && !$aField['skip_confirmation'] ? false : true;
        if ($_bConfirmed) {
            $this->deleteTransient($_sTransientKey);
        }
        return $_bConfirmed;
    }
    protected function _getInputFieldValueFromLabel($aField) {
        if (isset($aField['value']) && $aField['value'] != '') {
            return $aField['value'];
        }
        if (isset($aField['label'])) {
            return $aField['label'];
        }
        if (isset($aField['default'])) {
            return $aField['default'];
        }
    }
}
class AmazonAutoLinks_AdminPageFramework_FieldType_export extends AmazonAutoLinks_AdminPageFramework_FieldType_submit {
    public $aFieldTypeSlugs = array('export',);
    protected $aDefaultKeys = array('data' => null, 'format' => 'json', 'file_name' => null, 'attributes' => array('class' => 'button button-primary',),);
    protected function setUp() {
    }
    protected function getScripts() {
        return "";
    }
    protected function getStyles() {
        return "";
    }
    protected function getField($aField) {
        if (isset($aField['data'])) {
            $this->setTransient(md5("{$aField['class_name']}_{$aField['input_id']}"), $aField['data'], 60 * 2);
        }
        $aField['attributes']['name'] = "__export[submit][{$aField['input_id']}]";
        $aField['file_name'] = $aField['file_name'] ? $aField['file_name'] : $this->_generateExportFileName($aField['option_key'] ? $aField['option_key'] : $aField['class_name'], $aField['format']);
        $aField['label'] = $aField['label'] ? $aField['label'] : $this->oMsg->get('export');
        return parent::getField($aField);
    }
    protected function _getExtraInputFields(&$aField) {
        $_aAttributes = array('type' => 'hidden');
        return "<input " . $this->getAttributes(array('name' => "__export[{$aField['input_id']}][input_id]", 'value' => $aField['input_id'],) + $_aAttributes) . "/>" . "<input " . $this->getAttributes(array('name' => "__export[{$aField['input_id']}][field_id]", 'value' => $aField['field_id'],) + $_aAttributes) . "/>" . "<input " . $this->getAttributes(array('name' => "__export[{$aField['input_id']}][section_id]", 'value' => isset($aField['section_id']) && $aField['section_id'] != '_default' ? $aField['section_id'] : '',) + $_aAttributes) . "/>" . "<input " . $this->getAttributes(array('name' => "__export[{$aField['input_id']}][file_name]", 'value' => $aField['file_name'],) + $_aAttributes) . "/>" . "<input " . $this->getAttributes(array('name' => "__export[{$aField['input_id']}][format]", 'value' => $aField['format'],) + $_aAttributes) . "/>" . "<input " . $this->getAttributes(array('name' => "__export[{$aField['input_id']}][transient]", 'value' => isset($aField['data']),) + $_aAttributes) . "/>";
    }
    private function _generateExportFileName($sOptionKey, $sExportFormat = 'json') {
        switch (trim(strtolower($sExportFormat))) {
            case 'text':
                $sExt = "txt";
            break;
            case 'json':
                $sExt = "json";
            break;
            case 'array':
            default:
                $sExt = "txt";
            break;
        }
        return $sOptionKey . '_' . date("Ymd") . '.' . $sExt;
    }
}