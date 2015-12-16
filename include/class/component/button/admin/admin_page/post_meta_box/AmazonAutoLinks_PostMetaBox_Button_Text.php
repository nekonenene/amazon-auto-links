<?php
/**
 * Amazon Auto Links
 * 
 * http://en.michaeluno.jp/amazon-auto-links/
 * Copyright (c) 2013-2015 Michael Uno
 * 
 */

/**
 * Defines the meta box for the button post type.
 */
class AmazonAutoLinks_PostMetaBox_Button_Text extends AmazonAutoLinks_PostMetaBox_Button {

    public function setUp() {        
    
        $_oFields = new AmazonAutoLinks_FormFields_Button_Text;
        foreach( $_oFields->get() as $_aField ) {            
            $this->addSettingFields( $_aField );
        }      
                
    }
    
    
}