<?php

namespace BeyondCode\DuskDashboard;

use BeyondCode\DuskDashboard\Console\StartDashboardCommand;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use BeyondCode\DuskDashboard\Dusk\Browser;

class BrowserActionCollector
{
    protected $client;

    protected $testName;

    public function __construct($testName)
    {
        $this->testName = $testName;

        $this->client = new Client();
    }

    public function collect(string $action, array $arguments, Browser $browser, string $previousHtml = null)
    {
        $path = parse_url($browser->driver->getCurrentURL(), PHP_URL_PATH) ?? '';

        $action = new Action($action, $arguments, $browser->getCurrentPageSource(), $path);

        $action->setPreviousHtml($previousHtml);

        try {
            $this->pushAction($action);
        } catch (\Exception $e) {
            // Dusk-Dashboard Server might be turned off. No need to panic!
        }
    }

    protected function pushAction(Action $action)
    {
        $this->client->post('http://127.0.0.1:'.StartDashboardCommand::PORT.'/events', [
            RequestOptions::JSON => [
                'channel' => 'dusk-dashboard',
                'name' => 'dusk-event',
                'data' => [
                    'test' => $this->testName,
                    'path' => $action->getPath(),
                    'name' => $action->getName(),
                    'arguments' => $action->getArguments(),
                    'before' => $action->getPreviousHtml(),
                    'html' => $action->getHtml(),
                ],
            ],
        ]);
    }
}
