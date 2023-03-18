<?php

namespace RetchetApp\Socket;

use RetchetApp\Events\Event;

abstract class SocketAbstract
{
    protected function broadcast(Event $event)
    {
        return (new Broadcast($event, $this->clients));
    }
}