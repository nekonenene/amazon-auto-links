<?php
/**
 Admin Page Framework v3.7.3b02 by Michael Uno
 Generated by PHP Class Files Script Generator <https://github.com/michaeluno/PHP-Class-Files-Script-Generator>
 <http://en.michaeluno.jp/amazon-auto-links>
 Copyright (c) 2013-2015, Michael Uno; Licensed under MIT <http://opensource.org/licenses/MIT>
 */
class AmazonAutoLinks_AdminPageFramework_Form_View___CSS_widget extends AmazonAutoLinks_AdminPageFramework_Form_View___CSS_Base {
    protected function _get() {
        return $this->_getWidgetRules();
    }
    private function _getWidgetRules() {
        return <<<CSSRULES
/* Widget Forms [3.2.0+] */
.widget .amazon-auto-links-section .form-table > tbody > tr > td,
.widget .amazon-auto-links-section .form-table > tbody > tr > th
{
    display: inline-block;
    width: 100%;
    padding: 0;
    /* 3.4.0+ In IE inline-block does not take effect for td and th so make them float */
    float: right;
    clear: right;     
}

.widget .amazon-auto-links-field,
.widget .amazon-auto-links-input-label-container
{
    width: 100%;
}
.widget .sortable .amazon-auto-links-field {
    /* Sortable fields have paddings so the width needs to be adjusted to fit to 100% */
    padding: 4% 4.4% 3.2% 4.4%;
    width: 91.2%;
}
/* Give a slight margin between the input field and buttons */
.widget .amazon-auto-links-field input {
    margin-bottom: 0.1em;
    margin-top: 0.1em;
}

/* Input fields should have 100% width */
.widget .amazon-auto-links-field input[type=text],
.widget .amazon-auto-links-field textarea {
    width: 100%;
}

/* When the screen is less than 782px */ 
@media screen and ( max-width: 782px ) {
    
    /* The framework render fields with table elements and those container border seems to affect the width of fields */
    .widget .amazon-auto-links-fields {
        width: 99.2%;
    }    
    .widget .amazon-auto-links-field input[type='checkbox'], 
    .widget .amazon-auto-links-field input[type='radio'] 
    {
        margin-top: 0;
    }

}
CSSRULES;
        
    }
    protected function _getVersionSpecific() {
        $_sCSSRules = '';
        if (version_compare($GLOBALS['wp_version'], '3.8', '<')) {
            $_sCSSRules.= <<<CSSRULES

/* Fix tinyMCE width in 3.7x or below */
.widget .amazon-auto-links-section table.mceLayout {
    table-layout: fixed;
}
CSSRULES;
            
        }
        if (version_compare($GLOBALS['wp_version'], '3.8', '>=')) {
            $_sCSSRules.= <<<CSSRULES
/* Widget Forms */
.widget .amazon-auto-links-section .form-table th
{
    font-size: 13px;
    font-weight: normal;
    margin-bottom: 0.2em;
}

.widget .amazon-auto-links-section .form-table {
    margin-top: 1em;
}
  
CSSRULES;
            
        }
        return $_sCSSRules;
    }
}