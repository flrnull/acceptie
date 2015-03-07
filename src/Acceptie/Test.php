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
        $host = 'http://localhost:4444/wd/hub';
        //$capabilities = \DesiredCapabilities::firefox();
        $capabilities = \DesiredCapabilities::chrome();
        $driver = \RemoteWebDriver::create($host, $capabilities, 10);
        return new Browser($driver);
    }
}
