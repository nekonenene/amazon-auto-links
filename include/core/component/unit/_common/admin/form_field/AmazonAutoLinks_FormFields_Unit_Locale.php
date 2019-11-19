<?php
/**
 * Provides methods to retrieve field definitions for locales.
 *
 * @since           3.10.1
 */
class AmazonAutoLinks_FormFields_Unit_Locale extends AmazonAutoLinks_FormFields_Base {

    /**
     * Returns field definition arrays.
     * 
     * Pass an empty string to the parameter for meta box options. 
     * 
     * @return      array
     */    
    public function get( $sFieldIDPrefix='' ) {

        $_oOption      = AmazonAutoLinks_Option::getInstance();
        $_bAPIKeysSet  = $_oOption->isAPIKeySet();
        $_aAttributes  = $_bAPIKeysSet
            ? array()
            : array(
                'disabled' => 'disabled',
                'class'    => 'disabled read-only',
            );
        $_aFields        = array(
            array(
                'field_id'      => $sFieldIDPrefix . 'country',
                'type'          => 'text',
                'title'         => __( 'Country', 'amazon-auto-links' ),
                'attributes'    => array(
                    'readonly'=> 'readonly',
                ),
            ),
            array(
                'field_id'          => $sFieldIDPrefix . 'language',
                'type'              => 'select',
                'title'             => __( 'Preferred Language', 'amazon-auto-links' ),
                'label'             => array(), // will be assigned in the field_{class name} callback
                'description'       => array(
                    __( 'When the desired language is not available for the item, the default one set by Amazon will be applied.', 'amazon-auto-links' ),
                    $_bAPIKeysSet
                        ? ''
                        : '<span class="warning">* '
                            . sprintf(
                                __( '<a href="%1$s">Amazon Product Advertising API keys</a> must be set to enable this option.', 'amazon-auto-links' ),
                                AmazonAutoLinks_PluginUtility::getAPIAuthenticationPageURL()
                            )
                            . '</span>',
                ),
                'attributes'        => $_aAttributes,
            ),
            array(
                'field_id'          => $sFieldIDPrefix . 'preferred_currency',
                'type'              => 'select',
                'title'             => __( 'Preferred Currency', 'amazon-auto-links' ),
                'label'             => array(), // will be assigned in the field_{class name} callback
                'description'       => array(
                    __( 'When the desired currency is not available for the item, the default one set by Amazon will be applied.', 'amazon-auto-links' ),
                    $_bAPIKeysSet
                        ? ''
                        : '<span class="warning">* '
                            . sprintf(
                                __( '<a href="%1$s">Amazon Product Advertising API keys</a> must be set to enable this option.', 'amazon-auto-links' ),
                                AmazonAutoLinks_PluginUtility::getAPIAuthenticationPageURL()
                            )
                            . '</span>',
                ),
                'attributes'        => $_aAttributes,
            ),
        );
        return $_aFields;

    }
  
}