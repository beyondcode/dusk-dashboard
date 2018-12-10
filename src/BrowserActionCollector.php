<?php

namespace BeyondCode\DuskDashboard;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class BrowserActionCollector
{
    protected $client;

    protected $testName;

    protected $actions = [];

    public function __construct($testName)
    {
        $this->testName = $testName;

        $this->client = new Client();
    }

    public function collect(string $action, array $arguments, string $state)
    {
        $action = new Action($action, $arguments, $state);

        $this->actions[] = $action;

        try {
            $this->pushAction($action);
        } catch (\Exception $e) {
            // Dusk-Dashboard Server might be turned off. No need to panic!
        }
    }

    public function getActions()
    {
        return $this->actions;
    }

    public function getTestName()
    {
        return $this->testName;
    }

    protected function pushAction(Action $action)
    {
        /*
         * @todo this needs to be passed from the
         * dashboard process to the actual dusk test runner.
         */
        $this->client->post('http://127.0.0.1:6001/events', [
            RequestOptions::JSON => [
                'channel' => 'dusk-dashboard',
                'name' => 'dusk-event',
                'data' => [
                    'test' => $this->getTestName(),
                    'name' => $action->getName(),
                    'arguments' => $action->getArguments(),
                    'html' => $action->getHtml(),
                ],
            ],
        ]);
    }
}
