<?php

namespace BeyondCode\DuskDashboard\Ratchet\Server;

use Ratchet\Http\Router;
use Ratchet\Server\IoServer;
use React\EventLoop\LoopInterface;
use React\Socket\Server as Reactor;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RouteCollection;

class App extends \Ratchet\App
{

    public function __construct($httpHost = 'localhost', $port = 8080, $address = '127.0.0.1', LoopInterface $loop)
    {
        $this->httpHost = $httpHost;
        $this->port = $port;

        $socket = new Reactor($address.':'.$port, $loop);

        $this->routes = new RouteCollection;

        $urlMatcher = new UrlMatcher($this->routes, new RequestContext);

        $router = new Router($urlMatcher);

        $httpServer = new HttpServer($router);

        $this->_server = new IoServer($httpServer, $socket, $loop);
    }
}
