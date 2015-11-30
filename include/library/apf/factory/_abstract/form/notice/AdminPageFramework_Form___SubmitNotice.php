<?php
class AmazonAutoLinks_AdminPageFramework_Form___SubmitNotice extends AmazonAutoLinks_AdminPageFramework_WPUtility {
    static private $_aNotices = array();
    public function hasNotice($sType = '') {
        if (!$sType) {
            return ( bool )count(self::$_aNotices);
        }
        foreach (self::$_aNotices as $_aNotice) {
            $_sClassAttribute = $this->getElement($_aNotice, array('aAttributes', 'class'), '');
            if ($_sClassAttribute === $sType) {
                return true;
            }
        }
        return false;
    }
    public function set($sMessage, $sType = 'error', $asAttributes = array(), $bOverride = true) {
        if (empty(self::$_aNotices)) {
            add_action('shutdown', array($this, '_replyToSaveNotices'));
        }
        $_sID = md5(trim($sMessage));
        if (!$bOverride && isset(self::$_aNotices[$_sID])) {
            return;
        }
        if ($bOverride) {
            self::$_aNotices = array();
        }
        $_aAttributes = $this->getAsArray($asAttributes);
        if (is_string($asAttributes) && !empty($asAttributes)) {
            $_aAttributes['id'] = $asAttributes;
        }
        self::$_aNotices[$_sID] = array('sMessage' => $sMessage, 'aAttributes' => $_aAttributes + array('class' => $sType, 'id' => 'form_submit_notice_' . $_sID,),);
    }
    public function _replyToSaveNotices() {
        if (empty(self::$_aNotices)) {
            return;
        }
        $this->setTransient('apf_notices_' . get_current_user_id(), self::$_aNotices);
    }
    public function render() {
        new AmazonAutoLinks_AdminPageFramework_AdminNotice('');
        $_iUserID = get_current_user_id();
        $_aNotices = $this->getTransient("apf_notices_{$_iUserID}");
        if (false === $_aNotices) {
            return;
        }
        $this->deleteTransient("apf_notices_{$_iUserID}");
        if (isset($_GET['settings-notice']) && !$_GET['settings-notice']) {
            return;
        }
        $this->_printNotices($_aNotices);
    }
    private function _printNotices($aNotices) {
        $_aPeventDuplicates = array();
        foreach (array_filter(( array )$aNotices, 'is_array') as $_aNotice) {
            $_sNotificationKey = md5(serialize($_aNotice));
            if (isset($_aPeventDuplicates[$_sNotificationKey])) {
                continue;
            }
            $_aPeventDuplicates[$_sNotificationKey] = true;
            new AmazonAutoLinks_AdminPageFramework_AdminNotice($this->getElement($_aNotice, 'sMessage'), $this->getElement($_aNotice, 'aAttributes'));
        }
    }
}