<?php 
/**
	Admin Page Framework v3.7.10b10 by Michael Uno 
	Generated by PHP Class Files Script Generator <https://github.com/michaeluno/PHP-Class-Files-Script-Generator>
	<http://en.michaeluno.jp/amazon-auto-links>
	Copyright (c) 2013-2016, Michael Uno; Licensed under MIT <http://opensource.org/licenses/MIT> */
class AmazonAutoLinks_AdminPageFramework_Form_View___Attribute_SectionTableBody extends AmazonAutoLinks_AdminPageFramework_Form_View___Attribute_Base {
    public $sContext = 'section_table_content';
    protected function _getAttributes() {
        $_sCollapsibleType = $this->getElement($this->aArguments, array('collapsible', 'type'), 'box');
        return array('class' => $this->getAOrB($this->aArguments['_is_collapsible'], 'amazon-auto-links-collapsible-section-content' . ' ' . 'amazon-auto-links-collapsible-content' . ' ' . 'accordion-section-content' . ' ' . 'amazon-auto-links-collapsible-content-type-' . $_sCollapsibleType, null),);
    }
}
