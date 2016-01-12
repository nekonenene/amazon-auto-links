<?php 
/**
	Admin Page Framework v3.7.10b10 by Michael Uno 
	Generated by PHP Class Files Script Generator <https://github.com/michaeluno/PHP-Class-Files-Script-Generator>
	<http://en.michaeluno.jp/amazon-auto-links>
	Copyright (c) 2013-2016, Michael Uno; Licensed under MIT <http://opensource.org/licenses/MIT> */
class AmazonAutoLinks_AdminPageFramework_Form_View___DebugInfo extends AmazonAutoLinks_AdminPageFramework_FrameworkUtility {
    public $sStructureType = '';
    public $oMsg;
    public function __construct() {
        $_aParameters = func_get_args() + array($this->sStructureType, $this->oMsg,);
        $this->sStructureType = $_aParameters[0];
        $this->oMsg = $_aParameters[1];
    }
    public function get() {
        if (!$this->isDebugModeEnabled()) {
            return '';
        }
        if (!in_array($this->sStructureType, array('widget', 'post_meta_box', 'page_meta_box', 'user_meta'))) {
            return '';
        }
        return "<div class='amazon-auto-links-info'>" . $this->oMsg->get('debug_info') . ': ' . AmazonAutoLinks_AdminPageFramework_Registry::NAME . ' ' . AmazonAutoLinks_AdminPageFramework_Registry::getVersion() . "</div>";
    }
}
