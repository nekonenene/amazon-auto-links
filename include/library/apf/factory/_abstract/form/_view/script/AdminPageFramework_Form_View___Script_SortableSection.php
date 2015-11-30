<?php
class AmazonAutoLinks_AdminPageFramework_Form_View___Script_SortableSection extends AmazonAutoLinks_AdminPageFramework_Form_View___Script_SortableField {
    static public function getScript() {
        return <<<JAVASCRIPTS
(function($) {
    $.fn.enableAmazonAutoLinks_AdminPageFrameworkSortableSections = function( sSectionsContainerID ) {

        var _oTarget    = 'string' === typeof sSectionsContainerID 
            ? $( '#' + sSectionsContainerID + '.sortable-section' )
            : this;

        // For tabbed sections, enable the sort to the tabs.
        var _bIsTabbed      = _oTarget.hasClass( 'amazon-auto-links-section-tabs-contents' );
        var _bCollapsible   = 0 < _oTarget.children( '.amazon-auto-links-section.is_subsection_collapsible' ).length;

        var _oTarget        = _bIsTabbed
            ? _oTarget.find( 'ul.amazon-auto-links-section-tabs' )
            : _oTarget;

        _oTarget.unbind( 'sortupdate' );
        _oTarget.unbind( 'sortstop' );
        
        var _aSortableOptions = { 
                items: _bIsTabbed
                    ? '> li:not( .disabled )'
                    : '> div:not( .disabled, .amazon-auto-links-collapsible-toggle-all-button-container )', 
                handle: _bCollapsible
                    ? '.amazon-auto-links-section-caption'
                    : false,
                
                // @todo Figure out how to allow the user to highlight text in sortable elements.
                // cancel: '.amazon-auto-links-section-description, .amazon-auto-links-section-title'
                
            }
        var _oSortable  = _oTarget.sortable( _aSortableOptions );               
        
        if ( ! _bIsTabbed ) {
            
            _oSortable.bind( 'sortstop', function() {
                                    
                jQuery( this ).find( 'caption > .amazon-auto-links-section-title:not(.amazon-auto-links-collapsible-sections-title,.amazon-auto-links-collapsible-section-title)' ).first().show();
                jQuery( this ).find( 'caption > .amazon-auto-links-section-title:not(.amazon-auto-links-collapsible-sections-title,.amazon-auto-links-collapsible-section-title)' ).not( ':first' ).hide();
                
            } );            
            
        }            
    
    };
}( jQuery ));
JAVASCRIPTS;
        
    }
    static private $_aSetContainerIDsForSortableSections = array();
    static public function getEnabler($sContainerTagID, $aSettings, $oMsg) {
        if (empty($aSettings)) {
            return '';
        }
        if (in_array($sContainerTagID, self::$_aSetContainerIDsForSortableSections)) {
            return '';
        }
        self::$_aSetContainerIDsForSortableSections[$sContainerTagID] = $sContainerTagID;
        new self($oMsg);
        $_sScript = <<<JAVASCRIPTS
jQuery( document ).ready( function() {    
    jQuery( '#{$sContainerTagID}' ).enableAmazonAutoLinks_AdminPageFrameworkSortableSections( '{$sContainerTagID}' ); 
});            
JAVASCRIPTS;
        return "<script type='text/javascript' class='amazon-auto-links-section-sortable-script'>" . '/* <![CDATA[ */' . $_sScript . '/* ]]> */' . "</script>";
    }
}