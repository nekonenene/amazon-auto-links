<?php
/**
 * Amazon Auto Links
 * 
 * http://en.michaeluno.jp/amazon-auto-links/
 * Copyright (c) 2013-2016 Michael Uno
 * 
 */

/**
 * Plugin event handler.
 * 
 * @package      Amazon Auto Links
 * @since        2.0.0
 * @action       aal_action_simplepie_renew_cache
 * @action       aal_action_unit_prefetch
 * @action       aal_action_api_transient_renewal    
 * @action       aal_action_event_convert_template_options    
 * @filter       aal_filter_store_redirect_url - [2.0.5+] receives the redirecting url of the Amazon store
 */
class AmazonAutoLinks_Event {

    /**
     * Triggers event actions.
     */
    public function __construct() {
        add_action( 'aal_action_loaded_plugin', array( $this, 'replyToLoadEvents' ) );
    }
    
        /**
         * @return      void
         * @since       3.3.0
         */
        public function replyToLoadEvents() {

            do_action( 'aal_action_events' );
        
            new AmazonAutoLinks_Event_HTTPCacheRenewal;
            
            new AmazonAutoLinks_Event_Action_SimplePie_CacheRenewal(
                'aal_action_simplepie_renew_cache'  // action name
            );
            
            // 3.4.0+
            new AmazonAutoLinks_Event_Schedule_DeleteExpiredCaches;
            
            // @deprecated  3.3.0
            // new AmazonAutoLinks_Event_Action_TemplateOptionConverter(
                // 'aal_action_event_convert_template_options',
                // 2   // number of arguments
            // );
                    
            // This must be called after the above action hooks.
            $_oOption               = AmazonAutoLinks_Option::getInstance();
            $_bIsIntenceCachingMode = 'intense' === $_oOption->get( 'cache', 'chaching_mode' );
            
            // Force executing actions.
            new AmazonAutoLinks_Shadow(    
                $_bIsIntenceCachingMode
                    ? array(
                        'aal_action_unit_prefetch',
                        'aal_action_simplepie_renew_cache',
                        'aal_action_api_transient_renewal',
                        'aal_action_api_get_product_info',
                        'aal_action_api_get_customer_review',
                        'aal_action_api_get_similar_products',  // 3.3.0+
                        'aal_action_http_cache_renewal',
                        'aal_action_delete_expired_caches', // 3.4.0+
                    )
                    : array(
                        'aal_action_unit_prefetch',
                        'aal_action_api_get_product_info',
                        'aal_action_api_get_customer_review',
                        'aal_action_api_get_similar_products',  // 3.3.0+
                        'aal_action_http_cache_renewal',
                    )
            );    
                    
            if ( ! $_bIsIntenceCachingMode ) {
                if ( AmazonAutoLinks_Shadow::isBackground() ) {
                    exit;
                }
            }
                  
            $this->_handleQueryURL();
            
        }    
            /**
             * 
             * @since       3.1.0
             * @return      void
             */
            private function _handleQueryURL() {
                
                $_oOption     = AmazonAutoLinks_Option::getInstance();
                $_sQueryKey   = $_oOption->get( 'query', 'cloak' );
                if ( ! isset( $_GET[ $_sQueryKey ] ) ) {
                    return;
                }
                
                if ( 'feed' === $_GET[ $_sQueryKey ] ) {
                    new AmazonAutoLinks_Event_Feed;
                    return;
                }
                
                new AmazonAutoLinks_Event_Redirect( $_sQueryKey );
                
            }    
    
}
