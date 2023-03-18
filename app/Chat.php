<?php

namespace RetchetApp;

use Exception;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;
use RetchetApp\Events\UserLeft;
use RetchetApp\Socket\SocketAbstract;
use RetchetApp\Traits\ChatEventsTrait;

class Chat extends SocketAbstract implements MessageComponentInterface
{
    use ChatEventsTrait;
    protected array $clients;
    protected array $users;
    function onOpen(ConnectionInterface $connection)
    {
        $this->clients[$connection->resourceId] = $connection;
    }

    function onClose(ConnectionInterface $connection)
    {

        if(!isset($this->users[$connection->resourceId]))
        {
            return;
        }

        $user = $this->users[$connection->resourceId];

        $this->broadcast(new UserLeft($user))->toAll();

        unset($this->clients[$connection->resourceId], $this->users[$connection->resourceId]);
    }

    function onError(ConnectionInterface $connection, Exception $e)
    {
        $connection->close();
    }

    function onMessage(ConnectionInterface $from, $msg)
    {
        $msg = json_decode($msg);
        if(method_exists($this, $method = 'handle'. ucfirst($msg->event)))
        {
            $this->{$method}($from, $msg);
        }

    }


}