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
    public function pageTitle() {
        return $this->_driver->getTitle();
    }
}
