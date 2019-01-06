<?php
/**
 * Amazon Auto Links
 *
 * Generates links of Amazon products just coming out today. You just pick categories and they appear even in JavaScript disabled browsers.
 *
 * http://en.michaeluno.jp/amazon-auto-links/
 * Copyright (c) 2013-2018 Michael Uno
 */

/**
 * A class that provides methods to format sales rank outputs.
 *
 * @since       3.8.0
 */
class AmazonAutoLinks_UnitOutput___ElementFormatter_SalesRank extends AmazonAutoLinks_UnitOutput___ElementFormatter_Features {

    /**
     * @return      string
     * @throws      Exception
     * @since       3.5.0
     */
    public function get() {

        // For search-type units, this value is already set with API response.
        if ( ! empty( $this->_aProduct[ 'sales_rank' ] ) && null !== $this->_aProduct[ 'sales_rank' ] ) {
            return $this->_aProduct[ 'sales_rank' ];
        }

        $_snEncodedHTML = $this->_getCell( 'features' );
        if ( null === $_snEncodedHTML ) {
            return $this->_getPendingMessage(
                __( 'Now retrieving the sales rank.', 'amazon-auto-links' )
            );
        }
        return $this->___getFormattedOutput( $_snEncodedHTML );

    }
        /**
         * @since   3.8.0
         * @return  string
         */
        private function ___getFormattedOutput( $_snEncodedHTML ) {
            if ( '' === $_snEncodedHTML ) {
                return '';
            }
            return $this->getElement( $this->_aRow, 'sales_rank' );
        }


}