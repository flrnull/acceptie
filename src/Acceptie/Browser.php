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
     * @param string $name
     * @return string
     */
    public function getCookie($name) {
        $result = null;
        $cookieData = $this->_driver->manage()->getCookieNamed($name);
        if ($cookieData !== null) {
            $result = urldecode($cookieData['value']);
        }
        return $result;
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
     */
    public function submit($selector) {
        $this->_getElement($selector)->submit();
    }

    /**
     * @param string $attrName
     * @param string $selector
     * @return string
     */
    public function getAttributeValue($attrName, $selector) {
        return $this->_getElement($selector)->getAttribute($attrName);
    }

    /**
     * @param string $selector
     * @return string
     */
    public function getText($selector) {
        return $this->_getElement($selector)->getText();
    }

    /**
     * @param string $selector
     * @return bool
     */
    public function isElementExists($selector) {
        try {
            return $this->_getElement($selector)->getTagName() !== '';
        } catch (\InvalidSelectorException $e) {
            return false;
        }
    }

    /**
     * @param string $selector
     * @param string $text
     * @param int $timeout
     */
    public function waitForText($selector, $text, $timeout = null) {
        $this->_wait($timeout)->until(\WebDriverExpectedCondition::textToBePresentInElement($this->_getWebDriverBy($selector), $text));
    }

    /**
     * @param string $selector
     * @param string $pattern
     * @param int $timeout
     */
    public function waitForTextPattern($selector, $pattern, $timeout = null) {
        $this->_wait($timeout)->until(Condition::textPatternToBePresentInElement($this->_getWebDriverBy($selector), $pattern));
    }

    /**
     * @param string $selector
     * @return \RemoteWebElement
     */
    private function _getElement($selector) {
        return $this->_driver->findElement($this->_getWebDriverBy($selector));
    }

    /**
     * @param string $selector
     * @return \RemoteWebElement[]
     */
    private function _getElements($selector) {
        return $this->_driver->findElements($this->_getWebDriverBy($selector));
    }

    /**
     * @param string $selector
     * @return \WebDriverBy
     */
    private function _getWebDriverBy($selector) {
        if ($this->_isXPathSelector($selector)) {
            return \WebDriverBy::xpath($selector);
        } else {
            return \WebDriverBy::cssSelector($selector);
        }
    }

    /**
     * @param string $selector
     * @return bool
     */
    private function _isXPathSelector($selector) {
        return strpos($selector, "//") === 0;
    }

    /**
     * @param int $timeout
     * @return \WebDriverWait
     */
    private function _wait($timeout = null) {
        if ($timeout === null) {
            $timeout = 30;
        }
        return $this->_driver->wait($timeout);
    }
}
