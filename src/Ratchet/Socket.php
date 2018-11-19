<?php

namespace BeyondCode\DuskDashboard\Ratchet;

use Ratchet\ConnectionInterface;
use Ratchet\WebSocket\MessageComponentInterface;
use Symfony\Component\Process\Process;

class Socket implements MessageComponentInterface
{
    public static $connections = [];

    public function onOpen(ConnectionInterface $conn) {
        self::$connections[] = $conn;
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $data = json_decode($msg);

        if ($data->method === 'startTests') {
            $proc = new Process('php artisan dusk', base_path());
            $proc->start();
        }
    }

    public function onClose(ConnectionInterface $conn) {
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
    }
}