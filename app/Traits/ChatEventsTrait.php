<?php

namespace RetchetApp\Traits;

use Ratchet\ConnectionInterface;
use RetchetApp\Events\Message;
use RetchetApp\Events\UserJoined;
use RetchetApp\Events\Users;

trait ChatEventsTrait
{
    protected function handleMessage(ConnectionInterface $connection, $payload) : void
    {
        $user = $this->users[$connection->resourceId];

        $this->broadcast(new Message($user, $payload->data))->toAllExcept($connection);
    }
    protected function handleJoined(ConnectionInterface $connection, $message) : void
    {
        $user = $message->data->user;
        $this->users[$connection->resourceId] = $user;

        $this->broadcast(new Users($this->users))->to($connection);
        $this->broadcast(new UserJoined($user))->toAllExcept($connection);
    }
}