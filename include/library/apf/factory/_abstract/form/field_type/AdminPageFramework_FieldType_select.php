<?php
class AmazonAutoLinks_AdminPageFramework_FieldType_select extends AmazonAutoLinks_AdminPageFramework_FieldType {
    public $aFieldTypeSlugs = array('select',);
    protected $aDefaultKeys = array('label' => array(), 'is_multiple' => false, 'attributes' => array('select' => array('size' => 1, 'autofocusNew' => null, 'multiple' => null, 'required' => null,), 'optgroup' => array(), 'option' => array(),),);
    protected function getStyles() {
        return <<<CSSRULES
/* Select Field Type */
.amazon-auto-links-field-select .amazon-auto-links-input-label-container {
    vertical-align: top; 
}
.amazon-auto-links-field-select .amazon-auto-links-input-label-container {
    padding-right: 1em;
}
CSSRULES;
        
    }
    protected function getField($aField) {
        $_oSelectInput = new AmazonAutoLinks_AdminPageFramework_Input_select($aField['attributes']);
        if ($aField['is_multiple']) {
            $_oSelectInput->setAttribute(array('select', 'multiple'), 'multiple');
        }
        return $aField['before_label'] . "<div class='amazon-auto-links-input-label-container amazon-auto-links-select-label' style='min-width: " . $this->sanitizeLength($aField['label_min_width']) . ";'>" . "<label for='{$aField['input_id']}'>" . $aField['before_input'] . $_oSelectInput->get($aField['label']) . $aField['after_input'] . "<div class='repeatable-field-buttons'></div>" . "</label>" . "</div>" . $aField['after_label'];
    }
}