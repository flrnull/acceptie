<?php
/**
 * @author Evgeniy Udodov <flr.null@gmail.com>
 */

namespace Acceptie;

class Condition extends \WebDriverExpectedCondition {

    /**
     * @param \WebDriverBy $by
     * @param string $pattern
     * @return \WebDriverExpectedCondition
     */
    public static function textPatternToBePresentInElement(\WebDriverBy $by, $pattern) {
        return new \WebDriverExpectedCondition(
            /**
             * @param \RemoteWebDriver $driver
             */
            function (\RemoteWebDriver $driver) use ($by, $pattern) {
                try {
                    $elementText = $driver->findElement($by)->getText();
                    return preg_match($pattern, $elementText) === 1;
                } catch (\StaleElementReferenceException $e) {
                    return null;
                }
            }
        );
    }
}
