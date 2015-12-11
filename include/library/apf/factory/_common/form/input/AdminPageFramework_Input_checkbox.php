<?php
/**
 Admin Page Framework v3.7.2 by Michael Uno
 Generated by PHP Class Files Script Generator <https://github.com/michaeluno/PHP-Class-Files-Script-Generator>
 <http://en.michaeluno.jp/amazon-auto-links>
 Copyright (c) 2013-2015, Michael Uno; Licensed under MIT <http://opensource.org/licenses/MIT>
 */
class AmazonAutoLinks_AdminPageFramework_Input_checkbox extends AmazonAutoLinks_AdminPageFramework_Input_Base {
    public function get() {
        $_aParams = func_get_args() + array(0 => '', 1 => array());
        $_sLabel = $_aParams[0];
        $_aAttributes = $this->uniteArrays($this->getElementAsArray($_aParams, 1, array()), $this->aAttributes);
        return "<{$this->aOptions['input_container_tag']} " . $this->getAttributes($this->aOptions['input_container_attributes']) . ">" . "<input " . $this->getAttributes(array('type' => 'hidden', 'class' => $_aAttributes['class'], 'name' => $_aAttributes['name'], 'value' => '0',)) . " />" . "<input " . $this->getAttributes($_aAttributes) . " />" . "</{$this->aOptions['input_container_tag']}>" . "<{$this->aOptions['label_container_tag']} " . $this->getAttributes($this->aOptions['label_container_attributes']) . ">" . $_sLabel . "</{$this->aOptions['label_container_tag']}>";
    }
    public function getAttributesByKey() {
        $_aParams = func_get_args() + array(0 => '',);
        $_sKey = $_aParams[0];
        $_bIsMultiple = '' !== $_sKey;
        return $this->getElement($this->aAttributes, $_sKey, array()) + array('type' => 'checkbox', 'id' => $this->aAttributes['id'] . '_' . $_sKey, 'checked' => $this->_getCheckedAttributeValue($_sKey), 'value' => 1, 'name' => $_bIsMultiple ? "{$this->aAttributes['name']}[{$_sKey}]" : $this->aAttributes['name'], 'data-id' => $this->aAttributes['id'],) + $this->aAttributes;
    }
    private function _getCheckedAttributeValue($_sKey) {
        $_aValueDimension = '' === $_sKey ? array('value') : array('value', $_sKey);
        return $this->getElement($this->aAttributes, $_aValueDimension) ? 'checked' : null;
    }
}