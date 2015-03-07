<?php
/**
 * @author Evgeniy Udodov <flr.null@gmail.com>
 */

namespace Acceptie;

class Page extends Block {

    /**
     * @return string
     */
    public function title() {
        return $this->_browser->pageTitle();
    }
}
