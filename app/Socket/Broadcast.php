<?php

namespace RetchetApp\Socket;

use Ratchet\ConnectionInterface;
use RetchetApp\Events\Event;

use Ratchet\MessageComponentInterface;
class Broadcast
{
    public function __construct(protected Event $event, protected array $clients)
    {}

    public function toAll()
    {
        foreach ($this->clients as $client) {
                $client->send($this->event);
        }
    }

    public function toAllExcept(ConnectionInterface $connectionToExclude)
    {
        foreach ($this->clients as $client) {
            if($client !== $connectionToExclude)
            {
                $client->send($this->event);
            }
        }
    }
    public function to(ConnectionInterface $client)
    {
        $client->send($this->event);
    }
}