<?php 
/**
	Admin Page Framework v3.7.9b03 by Michael Uno 
	Generated by PHP Class Files Script Generator <https://github.com/michaeluno/PHP-Class-Files-Script-Generator>
	<http://en.michaeluno.jp/amazon-auto-links>
	Copyright (c) 2013-2015, Michael Uno; Licensed under MIT <http://opensource.org/licenses/MIT> */
class AmazonAutoLinks_AdminPageFramework_Form_View___Attribute_Fieldset extends AmazonAutoLinks_AdminPageFramework_Form_View___Attribute_FieldContainer_Base {
    public $sContext = 'fieldset';
    protected function _getAttributes() {
        return array('id' => $this->sContext . '-' . $this->aArguments['tag_id'], 'class' => 'amazon-auto-links-' . $this->sContext, 'data-field_id' => $this->aArguments['tag_id'],);
    }
}