<?php

namespace BeyondCode\DuskDashboard\Console;

use Illuminate\Console\Command;
use Ratchet\WebSocket\WsServer;
use Symfony\Component\Routing\Route;
use BeyondCode\DuskDashboard\Ratchet\Server\App;
use React\EventLoop\Factory as LoopFactory;
use BeyondCode\DuskDashboard\Ratchet\Http\EventController;
use BeyondCode\DuskDashboard\Ratchet\Socket;
use BeyondCode\DuskDashboard\Ratchet\Http\DashboardController;

class StartDashboardCommand extends Command
{
    protected $signature = 'dusk:dashboard {--port=6001}';

    protected $description = 'Start the Laravel Dusk Dashboard';

    /** @var App */
    protected $app;

    public function handle()
    {
        $url = parse_url(config('app.url'));

        $loop = LoopFactory::create();

        $loop->futureTick(function () use ($url) {
            $dashboardUrl = 'http://'.$url['host'].':'.$this->option('port').'/dashboard?port='.$this->option('port');

            $this->info('Started Dusk Dashboard on port '.$this->option('port'));

            $this->info('If the dashboard does not automatically open, visit: '.$dashboardUrl);

            exec('open '.$dashboardUrl);
        });

        $socket = new Socket();

        $this->app = new App($url['host'], $this->option('port'), '0.0.0.0', $loop);

        $this->app->route('/socket', new WsServer($socket), ['*']);

        $this->addRoutes();

        $this->app->run();
    }

    protected function addRoutes()
    {
        $eventRoute = new Route('/events', ['_controller' => new EventController()], [], [], null, [], ['POST']);

        $this->app->routes->add('events', $eventRoute);

        $dashboardRoute = new Route('/dashboard', ['_controller' => new DashboardController()], [], [], null, [], ['GET']);

        $this->app->routes->add('dashboard', $dashboardRoute);
    }
}
