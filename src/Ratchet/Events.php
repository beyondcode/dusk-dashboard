<?php

namespace BeyondCode\DuskDashboard\Ratchet;

use GuzzleHttp\Psr7\Response;
use Ratchet\ConnectionInterface;
use Ratchet\Http\HttpServerInterface;
use Psr\Http\Message\RequestInterface;

class Events implements HttpServerInterface
{
    /**
     * This is called before or after a socket is closed (depends on how it's closed).  SendMessage to $conn will not result in an error if it has already been closed.
     * @param  ConnectionInterface $conn The socket/connection that is closing/closed
     * @throws \Exception
     */
    public function onClose(ConnectionInterface $conn)
    {
    }

    /**
     * If there is an error with one of the sockets, or somewhere in the application where an Exception is thrown,
     * the Exception is sent back down the stack, handled by the Server and bubbled back up the application through this method.
     * @param  ConnectionInterface $conn
     * @param  \Exception $e
     * @throws \Exception
     */
    public function onError(ConnectionInterface $conn, \Exception $e)
    {
    }

    /**
     * @param \Ratchet\ConnectionInterface $conn
     * @param \Psr\Http\Message\RequestInterface $request null is default because PHP won't let me overload; don't pass null!!!
     * @throws \UnexpectedValueException if a RequestInterface is not passed
     */
    public function onOpen(ConnectionInterface $conn, RequestInterface $request = null)
    {
        try {
            /*
             * This is the post payload from our PHPUnit tests.
             * Send it to the connected connections.
             */
            foreach (Socket::$connections as $connection) {
                $connection->send($request->getBody());
            }
            $conn->send(\GuzzleHttp\Psr7\str(new Response(200)));
        } catch (\Exception $e) {
            $conn->send(\GuzzleHttp\Psr7\str(new Response(500, [], $e->getMessage())));
        }
        $conn->close();
    }

    /**
     * Triggered when a client sends data through the socket.
     * @param  \Ratchet\ConnectionInterface $from The socket/connection that sent the message to your application
     * @param  string $msg The message received
     * @throws \Exception
     */
    public function onMessage(ConnectionInterface $from, $msg)
    {
    }
}
