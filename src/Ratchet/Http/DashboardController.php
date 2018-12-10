<?php

namespace BeyondCode\DuskDashboard\Ratchet\Http;

use GuzzleHttp\Psr7\Response;
use Ratchet\ConnectionInterface;
use function GuzzleHttp\Psr7\str;
use Psr\Http\Message\RequestInterface;

class DashboardController extends Controller
{
    public function onOpen(ConnectionInterface $connection, RequestInterface $request = null)
    {
        $connection->send(
            str(new Response(
                200,
                ['Content-Type' => 'text/html'],
                file_get_contents(__DIR__.'/../../../resources/views/index.html')
            ))
        );

        $connection->close();
    }
}
