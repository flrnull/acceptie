<?php
/**
 * @author Evgeniy Udodov <flr.null@gmail.com>
 */

namespace Acceptie;

abstract class Block {

    /**
     * @var Browser
     */
    protected $_browser;

    /**
     * @param Browser $browser
     */
    final public function __construct(Browser $browser) {
        $this->_browser = $browser;
        $this->_initBlocks();
    }

    protected function _initBlocks() {

    }

    /**
     * @param string $className
     * @return self
     * @throws Exception
     */
    protected function _initBlock($className) {
        $block = new $className($this->_browser);
        if (!($block instanceof self)) {
            throw new Exception("Invalid block {$className}, should be instance of Block");
        }
        return $block;
    }
}
