<?php
/**
 * @author Evgeniy Udodov <flr.null@gmail.com>
 */

namespace Acceptie;

class Test extends \PHPUnit_Framework_TestCase {

    /**
     * @var Browser
     */
    public $browser;

    public function setUp() {
        parent::setUp();
        $this->browser = $this->_startBrowser();
    }

    private function _startBrowser() {
        $host = 'http://'.$this->_seleniumHost().':'.$this->_seleniumPort().'/wd/hub';
        $driver = $this->_seleniumDriver();
        if ($driver === 'firefox') {
            $capabilities = \DesiredCapabilities::firefox();
        } elseif($driver === 'chrome') {
            $capabilities = \DesiredCapabilities::chrome();
        } else {
            throw new Exception("Invalid driver name {$driver}");
        }
        $driver = \RemoteWebDriver::create($host, $capabilities, $this->_seleniumTimeout());
        return new Browser($driver);
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
