<?php
/**
 Admin Page Framework v3.7.6.1 by Michael Uno
 Generated by PHP Class Files Script Generator <https://github.com/michaeluno/PHP-Class-Files-Script-Generator>
 <http://en.michaeluno.jp/amazon-auto-links>
 Copyright (c) 2013-2015, Michael Uno; Licensed under MIT <http://opensource.org/licenses/MIT>
 */
class AmazonAutoLinks_AdminPageFramework_Property_PostType extends AmazonAutoLinks_AdminPageFramework_Property_Base {
    public $_sPropertyType = 'post_type';
    public $sPostType = '';
    public $aPostTypeArgs = array();
    public $sClassName = '';
    public $aColumnHeaders = array('cb' => '<input type="checkbox" />', 'title' => 'Title', 'author' => 'Author', 'comments' => '<div class="comment-grey-bubble"></div>', 'date' => 'Date',);
    public $aColumnSortable = array('title' => true, 'date' => true,);
    public $sCallerPath = '';
    public $aTaxonomies;
    public $aTaxonomyObjectTypes = array();
    public $aTaxonomyTableFilters = array();
    public $aTaxonomyRemoveSubmenuPages = array();
    public $bEnableAutoSave = true;
    public $bEnableAuthorTableFileter = false;
    public $aTaxonomySubMenuOrder = array();
}