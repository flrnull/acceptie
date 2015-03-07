<?php
/**
 * @author Evgeniy Udodov <flr.null@gmail.com>
 */

namespace Acceptie;

class Browser {

    /**
     * @var \RemoteWebDriver
     */
    private $_driver;

    /**
     * @param \RemoteWebDriver $driver
     */
    public function __construct(\RemoteWebDriver $driver) {
        $this->_driver = $driver;
    }

    /**
     * @param string $url
     */
    public function open($url) {
        $this->_driver->get($url);
    }

    /**
     * @return string
     */
    public function getPageTitle() {
        return $this->_driver->getTitle();
    }

    /**
     * @return string
     */
    public function getPageUrl() {
        return $this->_driver->getCurrentURL();
    }

    /**
     * @param string $selector
     * @param string $text
     */
    public function inputText($selector, $text) {
        $this->click($selector);
        $this->clearInput($selector);
        $this->pressKey($selector, $text);
    }

    /**
     * @param string $selector
     * @param string $keys
     */
    public function pressKey($selector, $keys) {
        foreach ($this->_getElements($selector) as $element) {
            $element->sendKeys($keys);
        }
    }

    /**
     * @param string $selector
     */
    public function clearInput($selector) {
        foreach ($this->_getElements($selector) as $element) {
            $element->clear();
        }
    }

    /**
     * @param string $selector
     */
    public function click($selector) {
        foreach ($this->_getElements($selector) as $element) {
            $element->click();
        }
    }

    /**
     * @param string $selector
     * @return \RemoteWebElement[]
     */
    private function _getElement($selector) {
        if ($this->_isXPathSelector($selector)) {
            return $this->_driver->findElement(\WebDriverBy::xpath($selector));
        } else {
            return $this->_driver->findElement(\WebDriverBy::cssSelector($selector));
        }
    }

    /**
     * @param string $selector
     * @return \RemoteWebElement[]
     */
    private function _getElements($selector) {
        if ($this->_isXPathSelector($selector)) {
            return $this->_driver->findElements(\WebDriverBy::xpath($selector));
        } else {
            return $this->_driver->findElements(\WebDriverBy::cssSelector($selector));
        }
    }

    /**
     * @param string $selector
     * @return bool
     */
    private function _isXPathSelector($selector) {
        return strpos($selector, "//") === 0;
    }
}
