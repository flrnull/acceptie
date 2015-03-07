<?php
/**
 * @author Evgeniy Udodov <flr.null@gmail.com>
 */

namespace Acceptie;

abstract class Test extends \PHPUnit_Framework_TestCase {

    /**
     * @var Browser
     */
    public $browser;

    /**
     * @var \RemoteWebDriver
     */
    private $_driver;

    public function setUp() {
        parent::setUp();
        $this->_initDriver();
        $this->_initBrowser();
    }

    public function tearDown() {
        parent::tearDown();
        $this->_closeDriver();
    }

    /**
     * @param string $selector
     */
    public function assertElementExists($selector) {
        $this->assertTrue($this->browser->isElementExists($selector), 'assertElementExists');
    }

    private function _initDriver() {
        $host = 'http://'.$this->_seleniumHost().':'.$this->_seleniumPort().'/wd/hub';
        $driverName = $this->_seleniumDriver();
        if ($driverName === 'firefox') {
            $capabilities = \DesiredCapabilities::firefox();
        } elseif($driverName === 'chrome') {
            $capabilities = \DesiredCapabilities::chrome();
        } else {
            throw new Exception("Invalid driver name {$driverName}");
        }
        $this->_driver = \RemoteWebDriver::create($host, $capabilities, $this->_seleniumTimeout());
    }

    private function _closeDriver() {
        $this->_driver->close();
    }

    private function _initBrowser() {
        $this->browser = new Browser($this->_driver);
    }

    /**
     * @return string
     */
    protected function _seleniumDriver() {
        return 'chrome';
    }

    /**
     * @return int
     */
    protected function _seleniumTimeout() {
        return 10000;
    }

    /**
     * @return string
     */
    protected function _seleniumHost() {
        return '127.0.0.1';
    }

    /**
     * @return int
     */
    protected function _seleniumPort() {
        return 4444;
    }
}
