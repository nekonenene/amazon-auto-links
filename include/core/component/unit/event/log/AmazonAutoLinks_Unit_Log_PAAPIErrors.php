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
 * Logs errors of Product Advertising API responses.
 *
 * @since        3.9.0
 */
class AmazonAutoLinks_Unit_Log_PAAPIErrors extends AmazonAutoLinks_PluginUtility {

    public function __construct() {

        // JSON
        add_filter( 'aal_filter_http_request_set_cache_api_product_info', array( $this, 'replyToCheckAPIHTTPCacheResponse' ), 10, 5 );
        add_filter( 'aal_filter_http_request_set_cache_api50_test', array( $this, 'replyToCheckAPIHTTPCacheResponse' ), 10, 5 );
        add_filter( 'aal_filter_http_request_set_cache_api', array( $this, 'replyToCheckAPIHTTPCacheResponse' ), 10, 5 );

        // HTML documents
        add_filter( 'aal_filter_http_request_set_cache_customer_review', array( $this, 'replyToCheckAPIHTTPCacheResponse' ), 10, 5 );
        add_filter( 'aal_filter_http_request_set_cache_customer_review2', array( $this, 'replyToCheckAPIHTTPCacheResponse' ), 10, 5 );
        add_filter( 'aal_filter_http_request_set_cache_url_unit_type', array( $this, 'replyToCheckAPIHTTPCacheResponse' ), 10, 5 );
        add_filter( 'aal_filter_http_request_set_cache_wp_remote_get', array( $this, 'replyToCheckAPIHTTPCacheResponse' ), 10, 5 );

    }

    /**
     * Called when an API HTTP response is about to be cached.
     * @param $mData
     * @param $sCacheName
     * @param $sCharSet
     * @param $iCacheDuration
     *
     * @return mixed
     * @since   3.9.0
     */
    public function replyToCheckAPIHTTPCacheResponse( $mData, $sCacheName, $sCharSet, $iCacheDuration, $sURL ) {

        $_sError = $this->___getError( $mData );
        if ( $_sError ) {
            $this->___setAPIErrorLog( $_sError, $sCacheName, $sURL );
        }

        // If it is the TooManyRequests error, give a cache short lifespan
        if( false !== strpos( $_sError, 'TooManyRequests' ) ){
            add_filter(
                'aal_filter_http_request_set_cache_duration_' . $sCacheName,
                array( $this, 'replyToGiveShortCacheDuration' ),
                10,
                4
            );
        }

        return $mData;

    }
        public function replyToGiveShortCacheDuration( $iCacheDuration, $sCacheName, $sURL, $sRequestType ) {
            remove_filter( 'aal_filter_http_request_set_cache_duration_' . $sCacheName, array( $this, 'replyToGiveShortCacheDuration' ), 10 );
            return 'api50_test' === $sRequestType
                ? 0
                : 60 * 10; // 10 minutes
        }

        /**
         * @param $mData
         * @return  string
         */
        private function ___getError( $mData ) {

            // WP_Error
            if ( is_wp_error( $mData ) ) {
                return $mData ->get_error_code() . ': ' . $mData ->get_error_message();
            }

            // HTTP Status Error
            $_sError  = $this->___getHTTPStatusError( $mData ) . ' ';

            $_sBody   = $this->getElement( $mData, array( 'body' ) );

            if ( $this->isJSON( $_sBody ) ) {

                $_aResponse = json_decode( $_sBody, true );

                // PA-API Error
                $_sError .= $this->___getAPIResponseFailure( $_aResponse );
                $_sError .= $this->___getAPIResponseError( $_aResponse );
            }

            return trim( $_sError );

        }
            private function ___getAPIResponseFailure( $_aResponse ) {
                if ( ! isset( $_aResponse[ '__type' ], $_aResponse[ 'message' ] ) ) {
                    return '';
                }
                $_sError = $_aResponse[ '__type' ] . ': ' . $_aResponse[ 'message' ];
                if ( isset( $_aResponse[ 'response' ] ) ) {
                    $_sError .= '; '
                        . $this->getElement( $_aResponse, array( 'response', 'code' ) )
                        . ': ' . $this->getElement( $_aResponse, array( 'response', 'message' ) );
                }
                return $_sError;
            }
            private function ___getAPIResponseError( $_aResponse ) {
                if ( ! isset( $_aResponse[ 'Errors' ] ) ) {
                    return '';
                }
                $_sError = '';
                foreach( $_aResponse[ 'Errors' ] as $_aError ) {
                    $_sError .= $_aError[ 'Code' ] . ': ' . $_aError[ 'Message' ] . ' ';
                }
                return trim( $_sError );
            }

            private function ___getHTTPStatusError( array $mData ) {
                $_sCode    = $this->getElement( $mData, array( 'response', 'code' ) );
                $_s1stChar = substr( $_sCode, 0, 1 );
                if ( in_array( $_s1stChar, array( 2, 3 ) ) ) {
                    return '';
                }
                return $_sCode . ': ' . $this->getElement( $mData, array( 'response', 'message' ) );
            }
        /**
         * @param $mData
         */
        private function ___setAPIErrorLog( $sErrorItem, $sCacheName, $sURL ) {

            $_sOptionKey = AmazonAutoLinks_Registry::$aOptionKeys[ 'error_log' ];
            $_aErrorLog  = $this->getAsArray( get_option( $_sOptionKey, array() ) );
            $_aErrorLog[ microtime( true ) ] = array(
                'time'           => time(),
                'cache_name'     => $sCacheName,
                'url'            => $sURL,
                'current_url'    => $this->getCurrentURL(),
                // 'note'       => '',
                'message'    => $sErrorItem,
            );
            // Keep up to latest 300 items
            $_aErrorLog = array_slice( $_aErrorLog, -300, 300, true );
            update_option( $_sOptionKey, $_aErrorLog );

        }

}