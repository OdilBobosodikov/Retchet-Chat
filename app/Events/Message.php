<?php

namespace RetchetApp\Events;

class Message extends Event
{

    public function __construct(private $user,private $payload)
    {

    }

    public function eventName()
    {
        return "message";
    }

    public function data()
    {
        $payload = $this->payload;
        $payload->user = $this->user;

        return $payload;
    }
}