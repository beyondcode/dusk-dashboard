<?php

namespace BeyondCode\DuskDashboard\Ratchet;

use Ratchet\ConnectionInterface;
use Symfony\Component\Process\Process;
use Ratchet\RFC6455\Messaging\MessageInterface;
use Ratchet\WebSocket\MessageComponentInterface;

class Socket implements MessageComponentInterface
{
    public static $connections = [];

    public function onOpen(ConnectionInterface $connection)
    {
        self::$connections[] = $connection;
    }

    public function onMessage(ConnectionInterface $from, MessageInterface $msg)
    {
        $data = json_decode($msg);

        if ($data->method === 'startTests') {
            $process = new Process('php artisan dusk', base_path());

            $process->start();
        }
    }

    public function onClose(ConnectionInterface $connection)
    {
    }

    public function onError(ConnectionInterface $connection, \Exception $e)
    {
    }
}
