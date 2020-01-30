<?php

namespace BeyondCode\DuskDashboard\Testing;

use BeyondCode\DuskDashboard\BrowserActionCollector;
use BeyondCode\DuskDashboard\Console\StartDashboardCommand;
use BeyondCode\DuskDashboard\Dusk\Browser;
use Closure;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Laravel\Dusk\TestCase as BaseTestCase;
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

    protected function enableNetworkLogging(DesiredCapabilities $capabilities): DesiredCapabilities
    {
        $chromeOptions = $capabilities->getCapability(ChromeOptions::CAPABILITY);

        $perfLoggingPrefs = new \stdClass();
        $perfLoggingPrefs->enableNetwork = true;

        $chromeOptions->setExperimentalOption('perfLoggingPrefs', $perfLoggingPrefs);

        $capabilities->setCapability(ChromeOptions::CAPABILITY, $chromeOptions);

        $loggingPrefs = new \stdClass();
        $loggingPrefs->browser = 'ALL';
        $loggingPrefs->performance = 'ALL';

        $capabilities->setCapability('loggingPrefs', $loggingPrefs);

        return $capabilities;
    }

    protected function onNotSuccessfulTest(Throwable $t): void
    {
        try {
            (new Client())->post('http://127.0.0.1:'.StartDashboardCommand::PORT.'/events', [
                RequestOptions::JSON => [
                    'channel' => 'dusk-dashboard',
                    'name' => 'dusk-failure',
                    'data' => [
                        'message' => $t->getMessage(),
                    ],
                ],
            ]);
        } catch (\Exception $e) {
            // Dashboard is offline
        } finally {
            parent::onNotSuccessfulTest($t);
        }
    }
}
