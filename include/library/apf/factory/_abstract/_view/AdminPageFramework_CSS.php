<?php
/**
 Admin Page Framework v3.7.7b02 by Michael Uno
 Generated by PHP Class Files Script Generator <https://github.com/michaeluno/PHP-Class-Files-Script-Generator>
 <http://en.michaeluno.jp/amazon-auto-links>
 Copyright (c) 2013-2015, Michael Uno; Licensed under MIT <http://opensource.org/licenses/MIT>
 */
class AmazonAutoLinks_AdminPageFramework_CSS {
    static public function getDefaultCSS() {
        $_sCSS = <<<CSSRULES
/* Settings Notice */
.wrap div.updated.amazon-auto-links-settings-notice-container, 
.wrap div.error.amazon-auto-links-settings-notice-container, 
.media-upload-form div.error.amazon-auto-links-settings-notice-container
{
    clear: both;
    margin-top: 16px;
}
.wrap div.error.confirmation.amazon-auto-links-settings-notice-container {
    border-color: #368ADD;
}  
      
/* Contextual Help Page */
.contextual-help-description {
    clear: left;    
    display: block;
    margin: 1em 0;
}
.contextual-help-tab-title {
    font-weight: bold;
}

/* Page Meta Boxes */
.amazon-auto-links-content {

    margin-bottom: 1.48em;     
    width: 100%; /* This allows float:right elements to go to the very right end of the page. */
    
    /* display: inline-table; */ /* @deprecated 3.5.0. Fixes the bottom margin getting placed at the top. */
    /* [3.5.0+] The above display: inline-table makes it hard to display code blocks with overflow as container cannot have solid width. */
    display: block; 

}

/* Regular Heading Titles - the meta box container element affects the styles of regular main content output. So it needs to be fixed. */
.amazon-auto-links-container #poststuff .amazon-auto-links-content h3 {
    font-weight: bold;
    font-size: 1.3em;
    margin: 1em 0;
    padding: 0;
    font-family: 'Open Sans', sans-serif;
} 

/* Tab Navigation Bar */
.nav-tab.tab-disabled,
.nav-tab.tab-disabled:hover {
    font-weight: normal;
    color: #AAAAAA;
}

/* In-page tabs */ 
.amazon-auto-links-in-page-tab .nav-tab.nav-tab-active {
    border-bottom-width: 2px;
}
/* Give a space between generic admin notice containers and the in-page navigation tabs */
.wrap .amazon-auto-links-in-page-tab div.error, 
.wrap .amazon-auto-links-in-page-tab div.updated {
    margin-top: 15px;
}

/* Framework System Information */
.amazon-auto-links-info {
    font-size: 0.8em;
    font-weight: lighter;
    text-align: right;
}

/* Debug containers */
pre.dump-array {
    border: 1px solid #ededed;
    margin: 24px 2em;
    margin: 1.714285714rem 2em;
    padding: 24px;
    padding: 1.714285714rem;				
    overflow-x: auto; 
    white-space: pre-wrap;
    background-color: #FFF;
    margin-bottom: 2em;
    width: auto;
}
CSSRULES;
        return $_sCSS . PHP_EOL . self::_getPageLoadStatsRules() . PHP_EOL . self::_getVersionSpecificRules();
    }
    static private function _getPageLoadStatsRules() {
        return <<<CSSRULES
/* Page Load Stats */
#amazon-auto-links-page-load-stats {
    clear: both;
    display: inline-block;
    width: 100%
}
#amazon-auto-links-page-load-stats li{
    display: inline;
    margin-right: 1em;
}     

/* To give the footer area more space */
#wpbody-content {
    padding-bottom: 140px;
}            
CSSRULES;
        
    }
    static private function _getVersionSpecificRules() {
        return '';
    }
    static public function getDefaultCSSIE() {
        return '';
    }
}