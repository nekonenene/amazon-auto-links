<?php
/**
 * Amazon Auto Links
 * 
 * http://en.michaeluno.jp/amazon-auto-links/
 * Copyright (c) 2013-2015 Michael Uno
 * 
 */

/**
 * Loads the units component.
 *  
 * @package     Amazon Auto Links
 * @since       3.3.0
*/
class AmazonAutoLinks_UnitTypeLoader_category extends AmazonAutoLinks_UnitTypeLoader_Base {
        
    /**
     * Stores the unit type slug.
     * @remark      Each extended class should assign own unique unit type slug here.
     * @since       3.3.0
     */
    public $sUnitTypeSlug = 'category';
    
    /**
     * Stores class names of form fields.
     */
    public $aFieldClasses = array(

// @todo add classes    
    
    );    
    
    /**
     * Adds post meta boxes.
     * 
     * @since       3.3.0
     * @return      void
     */
    public function loadAdminComponents( $sScriptPath ) {
        
        new AmazonAutoLinks_UnitPostMetaBox_Main_category(
            null,  // meta box ID - can be null. If null is passed, the ID gets automatically generated and the class name with all lower case characters will be applied.
            __( 'Main', 'amazon-auto-links' ), // meta box title
            array( // post type slugs: post, page, etc.
                AmazonAutoLinks_Registry::$aPostTypes[ 'unit' ] 
            ), 
            'normal', // context (what kind of metabox this is)
            'high' // priority                        
        );        
        
        new AmazonAutoLinks_UnitPostMetaBox_Submit_category(
            null, // meta box ID - can be null. If null is passed, the ID gets automatically generated and the class name with all lower case characters will be applied.
            __( 'Added Categories', 'amazon-auto-links' ), // title
            array( // post type slugs: post, page, etc.
                AmazonAutoLinks_Registry::$aPostTypes[ 'unit' ] 
            ), 
            'side', // context - e.g. 'normal', 'advanced', or 'side'
            'core' // priority - e.g. 'high', 'core', 'default' or 'low'
        );              
        
    }     
        
}