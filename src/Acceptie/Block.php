<?php
/**
 * @author Evgeniy Udodov <flr.null@gmail.com>
 */

namespace Acceptie;

class Block {

    /**
     * @var Browser
     */
    protected $_browser;

    /**
     * @param Browser $browser
     */
    public function __construct(Browser $browser) {
        $this->_browser = $browser;
    }
}
