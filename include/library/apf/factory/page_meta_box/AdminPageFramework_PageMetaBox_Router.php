<?php
abstract class AmazonAutoLinks_AdminPageFramework_PageMetaBox_Router extends AmazonAutoLinks_AdminPageFramework_MetaBox_View {
    public function __construct($sMetaBoxID, $sTitle, $asPageSlugs = array(), $sContext = 'normal', $sPriority = 'default', $sCapability = 'manage_options', $sTextDomain = 'amazon-auto-links') {
        parent::__construct($sMetaBoxID, $sTitle, $asPageSlugs, $sContext, $sPriority, $sCapability, $sTextDomain);
        $this->oUtil->addAndDoAction($this, "start_{$this->oProp->sClassName}", $this);
    }
    protected function _isInstantiatable() {
        if (isset($GLOBALS['pagenow']) && 'admin-ajax.php' === $GLOBALS['pagenow']) {
            return false;
        }
        return true;
    }
    public function _isInThePage() {
        if (!$this->oProp->bIsAdmin) {
            return false;
        }
        if (!isset($_GET['page'])) {
            return false;
        }
        if (array_key_exists($_GET['page'], $this->oProp->aPageSlugs)) {
            return true;
        }
        return in_array($_GET['page'], $this->oProp->aPageSlugs);
    }
}