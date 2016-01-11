<?php
/**
 * Amazon Auto Links
 * 
 * http://en.michaeluno.jp/amazon-auto-links/
 * Copyright (c) 2013-2015 Michael Uno
 * 
 */

/**
 * Loads the unit option converter component.
 * 
 * @package      Amazon Auto Links
 * @since        3.3.0
 */
class AmazonAutoLinks_UnitOptionConverterLoader {
        
    public function __construct() {
       
        // Events
        add_action( 'aal_action_events', array( $this, 'replyToLoad' ) );
        
        if ( is_admin() ) {
            new AmazonAutoLinks_UnitOptionConverter_Setting;
        }
        
    }
    
    public function replyToLoad() {
    
        new AmazonAutoLinks_Event_Action_UnitOptionConverter(
            'aal_action_event_convert_unit_options',
            2   // number of arguments
        );            
    
    }
    
}