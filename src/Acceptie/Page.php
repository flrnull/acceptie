<?php
/**
 * @author Evgeniy Udodov <flr.null@gmail.com>
 */

namespace Acceptie;

abstract class Page extends Block {

    /**
     * @return string
     */
    public function title() {
        return $this->_browser->getPageTitle();
    }

    /**
     * @return string
     */
    public function url() {
        return $this->_browser->getPageUrl();
    }

    /**
     * @return string
     */
    public function sourceCode() {
        return $this->_browser->getPageSourceCode();
    }

    /**
     * @param string $filePath
     * @return string binary png file
     */
    public function captureScreen($filePath = null) {
        return $this->_browser->capturePageScreen($filePath);
    }
}
