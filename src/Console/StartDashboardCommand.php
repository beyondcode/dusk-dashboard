<?php

namespace BeyondCode\DuskDashboard\Console;

use Illuminate\Console\Command;
use Ratchet\WebSocket\WsServer;
use Symfony\Component\Routing\Route;
use BeyondCode\DuskDashboard\Ratchet\App;
use React\EventLoop\Factory as LoopFactory;
use BeyondCode\DuskDashboard\Ratchet\Events;
use BeyondCode\DuskDashboard\Ratchet\Socket;
use BeyondCode\DuskDashboard\Ratchet\DashboardController;

class StartDashboardCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dusk:dashboard {--port=6001}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start the Laravel Dusk Dashboard';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $url = parse_url(config('app.url'));

        $loop = LoopFactory::create();

        $loop->futureTick(function () use ($url) {
            $dashboardUrl = 'http://'.$url['host'].':'.$this->option('port').'/dashboard';

            $this->info('Started Dusk Dashboard on port '.$this->option('port'));
            $this->info('If the dashboard does not automatically open, visit: '.$dashboardUrl);

            exec('open '.$dashboardUrl);
        });

        $socket = new Socket();

        $app = new App($url['host'], $this->option('port'), '0.0.0.0', $loop);
        $app->route('/socket', new WsServer($socket), ['*']);
        $app->routes->add('events', new Route('/events', ['_controller' => new Events()], [], [], null, [], ['POST']));
        $app->routes->add('dashboard', new Route('/dashboard', ['_controller' => new DashboardController()], [], [], null, [], ['GET']));
        $app->run();
    }
}
