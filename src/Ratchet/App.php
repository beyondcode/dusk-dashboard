<?php

namespace BeyondCode\DuskDashboard\Ratchet;

use Ratchet\Http\Router;
use Ratchet\Server\IoServer;
use Ratchet\Server\FlashPolicy;
use React\EventLoop\LoopInterface;
use React\Socket\Server as Reactor;
use React\EventLoop\Factory as LoopFactory;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Matcher\UrlMatcher;

class App extends \Ratchet\App
{
    /**
     * @param string        $httpHost   HTTP hostname clients intend to connect to. MUST match JS `new WebSocket('ws://$httpHost');`
     * @param int           $port       Port to listen on. If 80, assuming production, Flash on 843 otherwise expecting Flash to be proxied through 8843
     * @param string        $address    IP address to bind to. Default is localhost/proxy only. '0.0.0.0' for any machine.
     * @param LoopInterface $loop       Specific React\EventLoop to bind the application to. null will create one for you.
     */
    public function __construct($httpHost = 'localhost', $port = 8080, $address = '127.0.0.1', LoopInterface $loop = null)
    {
        if (null === $loop) {
            $loop = LoopFactory::create();
        }

        $this->httpHost = $httpHost;
        $this->port = $port;

        $socket = new Reactor($address.':'.$port, $loop);

        $this->routes = new RouteCollection;
        $this->_server = new IoServer(new HttpServer(new Router(new UrlMatcher($this->routes, new RequestContext))), $socket, $loop);

        $policy = new FlashPolicy;
        $policy->addAllowedAccess($httpHost, 80);
        $policy->addAllowedAccess($httpHost, $port);

        if (80 == $port) {
            $flashUri = '0.0.0.0:843';
        } else {
            $flashUri = 8843;
        }

        $flashSock = new Reactor($flashUri, $loop);
        $this->flashServer = new IoServer($policy, $flashSock);
    }
}
