<?php
/**
 Admin Page Framework v3.7.3b02 by Michael Uno
 Generated by PHP Class Files Script Generator <https://github.com/michaeluno/PHP-Class-Files-Script-Generator>
 <http://en.michaeluno.jp/amazon-auto-links>
 Copyright (c) 2013-2015, Michael Uno; Licensed under MIT <http://opensource.org/licenses/MIT>
 */
class AmazonAutoLinks_AdminPageFramework_Utility extends AmazonAutoLinks_AdminPageFramework_Utility_HTMLAttribute {
    static private $_aCallStack = array();
    static public function hasBeenCalled($sID) {
        if (isset(self::$_aCallStack[$sID])) {
            return true;
        }
        self::$_aCallStack[$sID] = true;
        return false;
    }
    static public function getOutputBuffer($oCallable, array $aParameters = array()) {
        ob_start();
        echo call_user_func_array($oCallable, $aParameters);
        $_sContent = ob_get_contents();
        ob_end_clean();
        return $_sContent;
    }
    static public function getObjectInfo($oInstance) {
        $_iCount = count(get_object_vars($oInstance));
        $_sClassName = get_class($oInstance);
        return '(object) ' . $_sClassName . ': ' . $_iCount . ' properties.';
    }
    static public function getAOrB($mValue, $mTrue = null, $mFalse = null) {
        return $mValue ? $mTrue : $mFalse;
    }
}