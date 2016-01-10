<?php 
/**
	Admin Page Framework v3.7.10b05 by Michael Uno 
	Generated by PHP Class Files Script Generator <https://github.com/michaeluno/PHP-Class-Files-Script-Generator>
	<http://en.michaeluno.jp/amazon-auto-links>
	Copyright (c) 2013-2016, Michael Uno; Licensed under MIT <http://opensource.org/licenses/MIT> */
class AmazonAutoLinks_AdminPageFramework_Property_widget extends AmazonAutoLinks_AdminPageFramework_Property_Base {
    public $_sPropertyType = 'widget';
    public $sStructureType = 'widget';
    public $sClassName = '';
    public $sCallerPath = '';
    public $sWidgetTitle = '';
    public $aWidgetArguments = array();
    public $bShowWidgetTitle = true;
    public $oWidget;
    public $sSettingNoticeActionHook = '';
    public function __construct($oCaller, $sCallerPath, $sClassName, $sCapability = 'manage_options', $sTextDomain = 'amazon-auto-links', $sStructureType) {
        $this->_sFormRegistrationHook = 'load_' . $sClassName;
        $this->sSettingNoticeActionHook = 'load_' . $sClassName;
        parent::__construct($oCaller, $sCallerPath, $sClassName, $sCapability, $sTextDomain, $sStructureType);
    }
}