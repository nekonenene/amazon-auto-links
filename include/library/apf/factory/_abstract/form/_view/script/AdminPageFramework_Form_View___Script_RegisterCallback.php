<?php
class AmazonAutoLinks_AdminPageFramework_Form_View___Script_RegisterCallback extends AmazonAutoLinks_AdminPageFramework_Form_View___Script_Base {
    static public function getScript() {
        return <<<JAVASCRIPTS
(function ( $ ) {
            
    // Callback containers.
    $.fn.aAmazonAutoLinks_AdminPageFrameworkAddRepeatableFieldCallbacks        = [];            
    $.fn.aAmazonAutoLinks_AdminPageFrameworkRemoveRepeatableFieldCallbacks     = [];
    $.fn.aAmazonAutoLinks_AdminPageFrameworkSortedFieldsCallbacks              = [];            
    $.fn.aAmazonAutoLinks_AdminPageFrameworkStoppedSortingFieldsCallbacks      = [];
    $.fn.aAmazonAutoLinks_AdminPageFrameworkAddedWidgetCallbacks               = [];
    
    /**
     * Gets triggered when a repeatable field add button is pressed.
     */  
    $( document ).bind( 'admin_page_framework_repeated_field', function( oEvent, sFieldType, sID, iCallType, iSectionIndex, iFieldIndex ){      

        var _oThisNode = jQuery( oEvent.target );
        $.each( $.fn.aAmazonAutoLinks_AdminPageFrameworkAddRepeatableFieldCallbacks, function( iIndex, aCallback ) {
            var _hfCallback  = aCallback[ 0 ];
            var _aFieldTypes = aCallback[ 1 ];       
            if ( 0 < _aFieldTypes.length && -1 === $.inArray( sFieldType, _aFieldTypes ) ) {
                return true; // continue
            }            
            if ( ! $.isFunction( _hfCallback ) ) { 
                return true;    // continue
            }   
            _hfCallback( _oThisNode, sFieldType, sID, iCallType, iSectionIndex, iFieldIndex );
        });
    });  
  
    /**
     * Supposed to get triggered when a repeatable field remove button is pressed.
     * @remark      Currently not used.
     */
    /* $( document ).bind( 'admin_page_framework_removed_field', function( oEvent, sFieldType, sID, iCallType, iSectionIndex, iFieldIndex ){
        var _oThisNode = jQuery( oEvent.target );
        $.each( $.fn.aAmazonAutoLinks_AdminPageFrameworkRemoveRepeatableFieldCallbacks, function( iIndex, aCallback ) {
            var _hfCallback  = aCallback[ 0 ];
            var _aFieldTypes = aCallback[ 1 ];       
            if ( 0 < _aFieldTypes.length && -1 === $.inArray( sFieldType, _aFieldTypes ) ) {
                return true; // continue
            }            
            if ( ! $.isFunction( _hfCallback ) ) { 
                return true;    // continue
            }   
            _hfCallback( _oThisNode, sFieldType, sID, iCallType, iSectionIndex, iFieldIndex );
        });
    });   */
 
    /**
     * Gets triggered when a sortable field is dropped and the sort event occurred.
     */
    $.fn.callBackSortedFields = function( sFieldType, sID, iCallType ) {
        var oThisNode = this;
        $.fn.aAmazonAutoLinks_AdminPageFrameworkSortedFieldsCallbacks.forEach( function( aCallback ) {
            var _hfCallback  = aCallback[ 0 ];
            var _aFieldTypes = aCallback[ 1 ];            
            if ( 0 < _aFieldTypes.length && -1 === $.inArray( sFieldType, _aFieldTypes ) ) {
                return true; // continue
            }            
            if ( jQuery.isFunction( _hfCallback ) ) { 
                _hfCallback( oThisNode, sFieldType, sID, iCallType ); 
            }
        });
    };

    /**
     * Gets triggered when sorting fields stopped.
     * @since   3.1.6
     */
    $.fn.callBackStoppedSortingFields = function( sFieldType, sID, iCallType ) {
        var oThisNode = this;
        $.fn.aAmazonAutoLinks_AdminPageFrameworkStoppedSortingFieldsCallbacks.forEach( function( aCallback ) {
            var _hfCallback  = aCallback[ 0 ];
            var _aFieldTypes = aCallback[ 1 ];            
            if ( 0 < _aFieldTypes.length && -1 === $.inArray( sFieldType, _aFieldTypes ) ) {
                return true; // continue
            }
            if ( jQuery.isFunction( _hfCallback ) ) { 
                _hfCallback( oThisNode, sFieldType, sID, iCallType ); 
            }
        });
    };            
    
    /**
     * Gets triggered when a widget of the framework is saved.
     * @since    3.2.0 
     */
    $( document ).bind( 'admin_page_framework_saved_widget', function( event, oWidget ){
        $.each( $.fn.aAmazonAutoLinks_AdminPageFrameworkAddedWidgetCallbacks, function( iIndex, aCallback ) {
            var _hfCallback  = aCallback[ 0 ];
            var _aFieldTypes = aCallback[ 1 ];
            if ( ! $.isFunction( _hfCallback ) ) { 
                return true;    // continue
            }   
            _hfCallback( oWidget ); 
        });            
    });
    
    /**
     * Registers callbacks. This will be called in each field type definition class.
     * 
     * @since       unknown
     * @since       3.6.0       Changed the name from `registerAPFCallback()`.
     */
    $.fn.registerAmazonAutoLinks_AdminPageFrameworkCallbacks = function( oCallbacks, aFieldTypeSlugs ) {
        
        // This is the easiest way to have default options.
        var oCallbacks = $.extend(
            {
                // The user specifies the settings with the following options.
                added_repeatable_field      : null,
                removed_repeatable_field    : null, // @deprecated 3.6.0
                sorted_fields               : null,
                stopped_sorting_fields      : null,
                saved_widget                : null,
            }, 
            oCallbacks 
        );
        var aFieldTypeSlugs = 'undefined' === typeof aFieldTypeSlugs 
            ? []
            : aFieldTypeSlugs;

        // Store the callback functions
        $.fn.aAmazonAutoLinks_AdminPageFrameworkAddRepeatableFieldCallbacks.push( 
            [ oCallbacks.added_repeatable_field, aFieldTypeSlugs ]
        );
        $.fn.aAmazonAutoLinks_AdminPageFrameworkRemoveRepeatableFieldCallbacks.push( 
            [ oCallbacks.removed_repeatable_field, aFieldTypeSlugs ]
        );
        $.fn.aAmazonAutoLinks_AdminPageFrameworkSortedFieldsCallbacks.push( 
            [ oCallbacks.sorted_fields, aFieldTypeSlugs ]
        );
        $.fn.aAmazonAutoLinks_AdminPageFrameworkStoppedSortingFieldsCallbacks.push( 
            [ oCallbacks.stopped_sorting_fields, aFieldTypeSlugs ]
        );
        $.fn.aAmazonAutoLinks_AdminPageFrameworkAddedWidgetCallbacks.push( 
            [ oCallbacks.saved_widget, aFieldTypeSlugs ]
        );

    };
    /**
     * An alias of the `registerAmazonAutoLinks_AdminPageFrameworkCalbacks()` method.
     * @remark      Kept for backward compatibility. There are some custom field types which calls the old method name. 
     */
    $.fn.registerAPFCallback = function( oCallbacks, aFieldTypeSlugs ) {
        $.fn.registerAmazonAutoLinks_AdminPageFrameworkCallbacks( oCallbacks, aFieldTypeSlugs );
    }
        
}( jQuery ));
JAVASCRIPTS;
        
    }
}