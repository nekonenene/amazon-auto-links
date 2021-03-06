<?php
/**
 * Amazon Auto Links
 *
 * Generates links of Amazon products just coming out today. You just pick categories and they appear even in JavaScript disabled browsers.
 *
 * http://en.michaeluno.jp/amazon-auto-links/
 * Copyright (c) 2013-2020 Michael Uno
 */


/**
 * Deals with the plugin admin pages.
 * 
 * @since       3.2.0
 */
class AmazonAutoLinks_URLUnitAdminPage extends AmazonAutoLinks_SimpleWizardAdminPage {
          
    /**
     * Sets the default option values for the setting form.
     * @callback    filter      options_{class name}
     * @return      array       The options array.
     */
    public function setOptions( $aOptions ) {
        
        $_oOption = AmazonAutoLinks_Option::getInstance();
        return $aOptions 
            + $this->_getLastUnitInputs()
            + $_oOption->get( 'unit_default' )  // 3.4.0+
            ;
            
    }

    /**
     * Sets up admin pages.
     */
    public function setUp() {
        
        // Page group root.
        $this->setRootMenuPageBySlug( 
            'edit.php?post_type=' . AmazonAutoLinks_Registry::$aPostTypes[ 'unit' ]
        );
                    
        // Add pages
        new AmazonAutoLinks_URLUnitAdminPage_URLUnit( $this );
     
    }
        
    /**
     * Page styling
     * @since       3
     * @return      void
     */
    public function doPageSettings() {                
        $this->setPageTitleVisibility( true ); // disable the page title of a specific page.   
    }

    public function load() {
//        $this->___checkAPIKeys(); // @deprecated  3.9.0
        AmazonAutoLinks_Unit_Admin_Utility::checkAPIKeys( $this );
    }
    /**
     * @deprecated  3.9.0
     */
/*        private function ___checkAPIKeys() {
            $_oOption = AmazonAutoLinks_Option::getInstance();
            if ( $_oOption->isAPIConnected() ) {
                return;
            }

            $this->setSettingNotice(
                __( 'You need to set API keys first to create a Search unit.', 'amazon-auto-links' ),
                'updated'
            );

            // Go to the Authentication tab of the Settings page.
            AmazonAutoLinks_PluginUtility::goToAPIAuthenticationPage();
        }*/
        
}