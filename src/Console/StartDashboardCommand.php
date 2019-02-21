<?php

namespace BeyondCode\DuskDashboard\Console;

use Clue\React\Buzz\Browser;
use Illuminate\Console\Command;
use Ratchet\WebSocket\WsServer;
use React\EventLoop\LoopInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Routing\Route;
use BeyondCode\DuskDashboard\Watcher;
use React\EventLoop\Factory as LoopFactory;
use BeyondCode\DuskDashboard\Ratchet\Socket;
use BeyondCode\DuskDashboard\DuskProcessFactory;
use BeyondCode\DuskDashboard\Ratchet\Server\App;
use BeyondCode\DuskDashboard\Ratchet\Http\EventController;
use BeyondCode\DuskDashboard\Ratchet\Http\DashboardController;

class StartDashboardCommand extends Command
{
    const PORT = 9773;

    protected $signature = 'dusk:dashboard';

    protected $description = 'Start the Laravel Dusk Dashboard';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->ignoreValidationErrors();
    }

    /** @var App */
    protected $app;

    /** @var LoopInterface */
    protected $loop;

    public function handle()
    {
        $url = parse_url(config('dusk-dashboard.host', config('app.url')));

        $this->loop = LoopFactory::create();

        $this->loop->futureTick(function () use ($url) {
            $dashboardUrl = 'http://'.$url['host'].':'.self::PORT.'/dashboard';

            $this->info('Started Dusk Dashboard on port '.self::PORT);

            $this->info('Your Dusk tests are now being watched.');

            $this->info('If the dashboard does not automatically open, visit: '.$dashboardUrl);

            $this->tryToOpenInBrowser($dashboardUrl);
        });

        $this->createTestWatcher();

        $this->createApp($url);
    }

    protected function addRoutes()
    {
        $eventRoute = new Route('/events', ['_controller' => new EventController()], [], [], null, [], ['POST']);

        $this->app->routes->add('events', $eventRoute);

        $dashboardRoute = new Route('/dashboard', ['_controller' => new DashboardController()], [], [], null, [], ['GET']);

        $this->app->routes->add('dashboard', $dashboardRoute);
    }

    protected function createTestWatcher()
    {
        $finder = (new Finder)
            ->name('*.php')
            ->files()
            ->in($this->getTestSuitePath());

        (new Watcher($finder, $this->loop))->startWatching(function () {
            $client = new Browser($this->loop);

            $client->post('http://127.0.0.1:'.StartDashboardCommand::PORT.'/events', [
                'Content-Type' => 'application/json',
            ], json_encode([
                    'channel' => 'dusk-dashboard',
                    'name' => 'dusk-reset',
                    'data' => [],
                ])
            );

            $process = DuskProcessFactory::make();

            $process->start();
        });
    }

    protected function getTestSuitePath()
    {
        $directories = [];

        if (file_exists(base_path('phpunit.dusk.xml'))) {
            $xml = simplexml_load_file(base_path('phpunit.dusk.xml'));

            foreach ($xml->testsuites->testsuite as $testsuite) {
                $directories[] = (string) $testsuite->directory;
            }
        } else {
            $directories[] = base_path('tests/Browser');
        }

        return $directories;
    }

    protected function createApp(array $url)
    {
        $socket = new Socket();

        $this->app = new App($url['host'], self::PORT, '0.0.0.0', $this->loop);

        $this->app->route('/socket', new WsServer($socket), ['*']);

        $this->addRoutes();

        $this->app->run();
    }

    protected function tryToOpenInBrowser($url)
    {
        if (PHP_OS === 'Darwin') {
            exec('open '.$url);
        }
    }
}
