<?php

namespace BeyondCode\DuskDashboard\Testing;

use Closure;
use BeyondCode\DuskDashboard\Dusk\Browser;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Laravel\Dusk\TestCase as BaseTestCase;
use BeyondCode\DuskDashboard\BrowserActionCollector;
use Throwable;

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
            $browser->setActionCollector(new BrowserActionCollector($this->getTestName()));
        }

        static::$browsers = $browsers;

        return static::$browsers;
    }

    protected function getTestName()
    {
        return class_basename(static::class).'::'.$this->getName();
    }

    protected function onNotSuccessfulTest(Throwable $t)
    {
        $client = new Client();

        $client->post('http://127.0.0.1:6001/events', [
            RequestOptions::JSON => [
                'channel' => 'dusk-dashboard',
                'name' => 'dusk-failure',
                'data' => [
                    'message' => $t->getMessage()
                ],
            ],
        ]);
    }
}
