<?php

namespace BeyondCode\DuskDashboard;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use BeyondCode\DuskDashboard\Dusk\Browser;
use BeyondCode\DuskDashboard\Console\StartDashboardCommand;

class BrowserActionCollector
{
    /** @var Client */
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

        $this->pushAction('dusk-event', [
            'test' => $this->testName,
            'path' => $action->getPath(),
            'name' => $action->getName(),
            'arguments' => $action->getArguments(),
            'before' => $action->getPreviousHtml(),
            'html' => $action->getHtml(),
        ]);

        $this->processPerformanceLog($browser);
    }

    protected function processPerformanceLog(Browser $browser)
    {
        $logs = collect([]);

        try {
            $logs = collect($browser->driver->manage()->getLog('performance'));
        } catch (\Exception $e) {
            // performance logging might be disabled.
        }

        $allowedMethods = [
            'Network.requestWillBeSent',
            'Network.responseReceived',
        ];

        $logs
            ->map(function ($log) {
                return json_decode($log['message']);
            })
            ->filter(function ($log) use ($allowedMethods) {
                $method = data_get($log, 'message.method');

                $type = data_get($log, 'message.params.type');

                return in_array($method, $allowedMethods) && $type === 'XHR';
            })->groupBy(function ($log) {
                if (data_get($log, 'message.method') === 'Network.requestWillBeSent') {
                    return data_get($log, 'message.requestId');
                }

                return data_get($log, 'params.requestId');
            })->map(function ($log) use ($browser) {
                $this->pushPerformanceLog($log->toArray(), $browser);
            });
    }

    protected function pushAction(string $name, array $payload)
    {
        try {
            $this->client->post('http://127.0.0.1:'.StartDashboardCommand::PORT.'/events', [
                RequestOptions::JSON => [
                    'channel' => 'dusk-dashboard',
                    'name' => $name,
                    'data' => $payload,
                ],
            ]);
        } catch (\Exception $e) {
            // Dusk-Dashboard Server might be turned off. No need to panic!
        }
    }

    protected function pushPerformanceLog(array $log, Browser $browser)
    {
        $request = $log[0];
        $response = $log[1];

        $url = parse_url(data_get($request, 'message.params.request.url'));

        $this->pushAction('dusk-event', [
            'test' => $this->testName,
            'name' => 'XHR',
            'arguments' => [
                data_get($request, 'message.params.request.method').' '.
                $url['path'].' '.
                data_get($response, 'message.params.response.status').' '.
                data_get($response, 'message.params.response.statusText'),
            ],
            'html' => $browser->getCurrentPageSource(),
            'logs' => $log,
        ]);
    }
}
