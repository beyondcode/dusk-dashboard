<?php

namespace BeyondCode\DuskDashboard\Ratchet;

use Ratchet\ConnectionInterface;
use Ratchet\RFC6455\Messaging\MessageInterface;
use BeyondCode\DuskDashboard\DuskProcessFactory;
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
            $process = DuskProcessFactory::make();

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
