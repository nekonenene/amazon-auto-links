<?php
/**
 * Amazon Auto Links
 * 
 * http://en.michaeluno.jp/amazon-auto-links/
 * Copyright (c) 2013-2015 Michael Uno
 * 
 */

/**
 * Redirects the visitor to an appropriate page depending on the request.
 * @package      Amazon Auto Links
 * @since        3
 * 
 * @filter      apply       aal_filter_store_redirect_url   
 */
class AmazonAutoLinks_Event_Redirect {
    
    /**
     * Routes url requests.
     * @since       3
     * @since       3.0.1       Added the `$sQueryKey` parameter.
     */
    public function __construct( $sQueryKey ) {
       
        // At this point, it is a cloaked url.
        $_sQueryValue = $_GET[ $sQueryKey ];
       
        if ( 'vendor' === $_sQueryValue ) {
            $this->_goToVendor();
        }
        
        $this->_goToStore( $_GET[ $sQueryKey ], $_GET );    
        
    }
    
    /**
     * Redirects the user to the vendor site.
     */
    private function _goToVendor() {

        $_sURL          = AmazonAutoLinks_Registry::PLUGIN_URI;
        $_oOption       = AmazonAutoLinks_Option::getInstance();
        $_isAffiliateID = $_oOption->get( 'miunosoft_affiliate', 'affiliate_id' );
        if ( strlen( $_isAffiliateID ) ) {
            $_sURL = add_query_arg(
                array(
                    'ref'   => $_isAffiliateID,
                ),
                AmazonAutoLinks_Registry::STORE_URI_PRO
            );
        }

        exit(
            wp_redirect(
                $_sURL
            )
        );
    }
    
    /**
     * 
     * For URL cloaking redirects.
     */
    private function _goToStore( $sASIN, $aArgs ) {
        
        $aArgs = $aArgs + array(
            'locale' => null,
            'tag'    => null,
            'ref'    => null,
        );
        
        // http://www.amazon.[domain-suffix]/dp/ASIN/[asin]/ref=[...]?tag=[associate-id]
        $_sURL      = isset( AmazonAutoLinks_Property::$aCategoryRootURLs[ strtoupper( $aArgs['locale'] ) ] )
            ? AmazonAutoLinks_Property::$aCategoryRootURLs[ strtoupper( $aArgs['locale'] ) ]
            : AmazonAutoLinks_Property::$aCategoryRootURLs['US'];
        
        $_aURLelem  = parse_url( $_sURL );
        $_sStoreURL = $_aURLelem[ 'scheme' ] . '://' . $_aURLelem[ 'host' ]
            . '/dp/ASIN/' . $sASIN . '/' 
            . ( empty( $aArgs['ref'] ) ? '' : 'ref=nosim' )
            . "?tag={$aArgs['tag']}";
        
        exit( 
            wp_redirect( 
                apply_filters( 
                    'aal_filter_store_redirect_url',
                    $_sStoreURL 
                ) 
            ) 
        );
                
    }
    
}