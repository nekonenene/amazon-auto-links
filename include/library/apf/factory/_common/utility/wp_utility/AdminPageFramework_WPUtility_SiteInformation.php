<?php
/**
 Admin Page Framework v3.7.4b07 by Michael Uno
 Generated by PHP Class Files Script Generator <https://github.com/michaeluno/PHP-Class-Files-Script-Generator>
 <http://en.michaeluno.jp/amazon-auto-links>
 Copyright (c) 2013-2015, Michael Uno; Licensed under MIT <http://opensource.org/licenses/MIT>
 */
class AmazonAutoLinks_AdminPageFramework_WPUtility_SiteInformation extends AmazonAutoLinks_AdminPageFramework_WPUtility_Meta {
    static public function isDebugModeEnabled() {
        return ( bool )defined('WP_DEBUG') && WP_DEBUG;
    }
    static public function isDebugLogEnabled() {
        return ( bool )defined('WP_DEBUG_LOG') && WP_DEBUG_LOG;
    }
    static public function isDebugDisplayEnabled() {
        return ( bool )defined('WP_DEBUG_DISPLAY') && WP_DEBUG_DISPLAY;
    }
    static public function getSiteLanguage($sDefault = 'en_US') {
        return defined('WPLANG') && WPLANG ? WPLANG : $sDefault;
    }
}