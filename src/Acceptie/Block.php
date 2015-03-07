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
     * @var string
     */
    protected $_selector;

    /**
     * @param Browser $browser
     * @param string $selector
     */
    final public function __construct(Browser $browser, $selector = null) {
        $this->_browser = $browser;
        $this->_selector = $selector;
        $this->_initBlocks();
    }

    /**
     * @return string
     */
    public function selector() {
        return $this->_selector;
    }

    /**
     * @param string $name
     * @return string
     */
    public function attribute($name) {
        return $this->_browser->getAttributeValue($name, $this->_selector);
    }

    protected function _initBlocks() {

    }

    /**
     * @param string $className
     * @param string $selector
     * @return self
     * @throws Exception
     */
    protected function _initBlock($className, $selector = null) {
        $block = new $className($this->_browser, $selector);
        if (!($block instanceof self)) {
            throw new Exception("Invalid block {$className}, should be instance of Block");
        }
        return $block;
    }
}
