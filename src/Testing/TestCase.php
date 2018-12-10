<?php

namespace BeyondCode\DuskDashboard\Testing;

use BeyondCode\DuskDashboard\Dusk\Browser;
use BeyondCode\DuskDashboard\BrowserActionCollector;
use Closure;
use Laravel\Dusk\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * Create a new Browser instance.
     *
     * @param  \Facebook\WebDriver\Remote\RemoteWebDriver  $driver
     * @return \BeyondCode\DuskDashboard\Dusk\Browser
     */
    protected function newBrowser($driver)
    {
        return new Browser($driver);
    }

    /**
     * Create the browser instances needed for the given callback.
     *
     * @param  \Closure  $callback
     * @return array
     * @throws \ReflectionException
     */
    protected function createBrowsersFor(Closure $callback)
    {
        $browsers = parent::createBrowsersFor($callback);

        foreach ($browsers as $browser) {
            $browser->setActionCollector(new BrowserActionCollector($this->getName()));
        }

        static::$browsers = $browsers;

        return static::$browsers;
    }
}
