<?php
/**
 Admin Page Framework v3.7.3b02 by Michael Uno
 Generated by PHP Class Files Script Generator <https://github.com/michaeluno/PHP-Class-Files-Script-Generator>
 <http://en.michaeluno.jp/amazon-auto-links>
 Copyright (c) 2013-2015, Michael Uno; Licensed under MIT <http://opensource.org/licenses/MIT>
 */
abstract class AmazonAutoLinks_AdminPageFramework_MetaBox extends AmazonAutoLinks_AdminPageFramework_MetaBox_Controller {
    static protected $_sStructureType = 'post_meta_box';
    function __construct($sMetaBoxID, $sTitle, $asPostTypeOrScreenID = array('post'), $sContext = 'normal', $sPriority = 'default', $sCapability = 'edit_posts', $sTextDomain = 'amazon-auto-links') {
        if (!$this->_isInstantiatable()) {
            return;
        }
        $this->oProp = new AmazonAutoLinks_AdminPageFramework_Property_MetaBox($this, get_class($this), $sCapability, $sTextDomain, self::$_sStructureType);
        $this->oProp->aPostTypes = is_string($asPostTypeOrScreenID) ? array($asPostTypeOrScreenID) : $asPostTypeOrScreenID;
        parent::__construct($sMetaBoxID, $sTitle, $asPostTypeOrScreenID, $sContext, $sPriority, $sCapability, $sTextDomain);
        $this->oUtil->addAndDoAction($this, "start_{$this->oProp->sClassName}", $this);
    }
}