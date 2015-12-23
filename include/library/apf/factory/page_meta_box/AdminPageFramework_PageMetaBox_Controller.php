<?php
/**
 Admin Page Framework v3.7.6.1 by Michael Uno
 Generated by PHP Class Files Script Generator <https://github.com/michaeluno/PHP-Class-Files-Script-Generator>
 <http://en.michaeluno.jp/amazon-auto-links>
 Copyright (c) 2013-2015, Michael Uno; Licensed under MIT <http://opensource.org/licenses/MIT>
 */
abstract class AmazonAutoLinks_AdminPageFramework_PageMetaBox_Controller extends AmazonAutoLinks_AdminPageFramework_PageMetaBox_View {
    public function enqueueStyles($aSRCs, $sPageSlug = '', $sTabSlug = '', $aCustomArgs = array()) {
        if (method_exists($this->oResource, '_enqueueStyles')) {
            return $this->oResource->_enqueueStyles($aSRCs, $sPageSlug, $sTabSlug, $aCustomArgs);
        }
    }
    public function enqueueStyle($sSRC, $sPageSlug = '', $sTabSlug = '', $aCustomArgs = array()) {
        if (method_exists($this->oResource, '_enqueueStyle')) {
            return $this->oResource->_enqueueStyle($sSRC, $sPageSlug, $sTabSlug, $aCustomArgs);
        }
    }
    public function enqueueScripts($aSRCs, $sPageSlug = '', $sTabSlug = '', $aCustomArgs = array()) {
        if (method_exists($this->oResource, '_enqueueScripts')) {
            return $this->oResource->_enqueueScripts($sSRC, $sPageSlug, $sTabSlug, $aCustomArgs);
        }
    }
    public function enqueueScript($sSRC, $sPageSlug = '', $sTabSlug = '', $aCustomArgs = array()) {
        if (method_exists($this->oResource, '_enqueueScript')) {
            return $this->oResource->_enqueueScript($sSRC, $sPageSlug, $sTabSlug, $aCustomArgs);
        }
    }
}