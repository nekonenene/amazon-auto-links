<?php
/**
 Admin Page Framework v3.7.7b02 by Michael Uno
 Generated by PHP Class Files Script Generator <https://github.com/michaeluno/PHP-Class-Files-Script-Generator>
 <http://en.michaeluno.jp/amazon-auto-links>
 Copyright (c) 2013-2015, Michael Uno; Licensed under MIT <http://opensource.org/licenses/MIT>
 */
class AmazonAutoLinks_AdminPageFramework_Factory_View__SettingNotice extends AmazonAutoLinks_AdminPageFramework_FrameworkUtility {
    public $oFactory;
    public function __construct($oFactory) {
        $this->oFactory = $oFactory;
        if (is_network_admin()) {
            add_action('network_admin_notices', array($this, '_replyToPrintSettingNotice'));
        } else {
            add_action('admin_notices', array($this, '_replyToPrintSettingNotice'));
        }
    }
    public function _replyToPrintSettingNotice() {
        if (!$this->_shouldProceed()) {
            return;
        }
        $this->oFactory->oForm->printSubmitNotices();
    }
    private function _shouldProceed() {
        if (!$this->oFactory->_isInThePage()) {
            return false;
        }
        if ($this->hasBeenCalled(__METHOD__)) {
            return false;
        }
        return true;
    }
}