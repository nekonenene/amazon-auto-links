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
 * A class that provides methods to format content outputs.
 * 
 * For `search` unit types including the `url` unit type, this is not needed as the API response contains content element (Editor Review). 
 * However, for the `category` unit type does not and it accesses the database when `%content%` or `%description%` variables are present in the `Item Format` unit option.
 *
 * @since       3.9.0
 */
class AmazonAutoLinks_UnitOutput___ElementFormatter_Content extends AmazonAutoLinks_UnitOutput___ElementFormatter_Base {

    /**
     * @return      string
     * @throws      Exception
     * @since       3.9.0
     */
    public function get() {

        // For search-type units, this value is already set with API response.
        if ( $this->_aProduct[ 'content' ] ) {
            return $this->_aProduct[ 'content' ];
        }

        $_sPriceFormatted = $this->_getCell( 'price_formatted' );
        if ( null === $_sPriceFormatted ) {
            return $this->_getPendingMessage(
                __( 'Now retrieving the price.', 'amazon-auto-links' )
            );
        }
        return $this->___getFormattedOutput( $_sPriceFormatted );

    }
        /**
         * @since   3.9.0
         * @return  string
         */
        private function ___getFormattedOutput( $sPriceFormatted ) {
            if ( '' === $sPriceFormatted ) {
                return '';
            }
            $inLowestNew          = $this->_getCell( 'lowest_new_price' );
            $inDiscounted         = $this->_getCell( 'discounted_price' );
            $sDiscountedFormatted = $this->_getCell( 'discounted_price_formatted' );
            $sLowestNewFormatted  = $this->_getCell( 'lowest_new_price_formatted' );
            return AmazonAutoLinks_Unit_Utility::getPrice(
                $sPriceFormatted,
                $inDiscounted,
                $inLowestNew,
                $sDiscountedFormatted,
                $sLowestNewFormatted
            );
        }

            /**
             * Generates a price output with a discount price if available.
             * @since       3.4.11
             * @since       3.9.0       Moved from `AmazonAutoLinks_UnitOutput_Base_ElementFormatter`.
             * @return      string
             * @deprecated  3.8.11      Moved to `AmazonAutoLinks_Unit_Utility`.
             */
/*            private function ___getPriceOutput( $_sPriceFormatted ) {

                $_inLowestNew           = $this->_getCell( 'lowest_new_price' );
                $_inDiscount            = $this->_getCell( 'discounted_price' );
                $_inOffered             = $this->___getLowestPrice( $_inLowestNew, $_inDiscount );
                $_sLowestColumnName     = $_inDiscount === $_inOffered ? 'discounted_price_formatted' : 'lowest_new_price_formatted';
                $_sLowestFormatted      = $this->_getCell( $_sLowestColumnName );
                $_bDiscounted           = $_sLowestFormatted && ( $_sPriceFormatted !== $_sLowestFormatted );
                return $_bDiscounted
                    ? '<span class="proper-price"><s>' . $_sPriceFormatted . '</s></span> '
                        . '<span class="offered-price">' . $_sLowestFormatted . '</span>'
                    : '<span class="offered-price">' . $_sPriceFormatted . '</span>';

            }*/
                /**
                 * @param   integer $_iLowestNew
                 * @param   integer $_iDiscount
                 * @return  integer|null
                 * @since   3.4.11
                 * @since   3.9.0       Moved from `AmazonAutoLinks_UnitOutput_Base_ElementFormatter`.
                 * @deprecated  3.8.11
                 */
/*                private function ___getLowestPrice( $_iLowestNew, $_iDiscount ) {
                    $_aOfferedPrices        = array();
                    if ( null !== $_iLowestNew ) {
                        $_aOfferedPrices[] = ( integer ) $_iLowestNew;
                    }
                    if ( null !== $_iDiscount ) {
                        $_aOfferedPrices[] = ( integer ) $_iDiscount;
                    }
                    return ! empty( $_aOfferedPrices )
                        ? min( $_aOfferedPrices )
                        : null;
                }*/

}