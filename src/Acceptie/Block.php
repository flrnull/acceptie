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

    /**
     * @param string $text
     * @param int $timeout
     */
    public function waitForText($text, $timeout = null) {
        $this->_browser->waitForText($this->_selector, $text, $timeout);
    }

    /**
     * @param string $pattern
     * @param int $timeout
     */
    public function waitForTextPattern($pattern, $timeout = null) {
        $this->_browser->waitForTextPattern($this->_selector, $pattern, $timeout);
    }

    /**
     * @return string
     */
    public function text() {
        return $this->_browser->getText($this->_selector);
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
