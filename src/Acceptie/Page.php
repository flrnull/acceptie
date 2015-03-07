<?php
/**
 * @author Evgeniy Udodov <flr.null@gmail.com>
 */

namespace Acceptie;

abstract class Page extends Block {

    /**
     * @return string
     */
    public function title() {
        return $this->_browser->getPageTitle();
    }

    /**
     * @return string
     */
    public function url() {
        return $this->_browser->getPageUrl();
    }
}
