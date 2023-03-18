<?php

namespace RetchetApp\Events;

class UserJoined extends Event
{
    public function __construct(protected $user)
    {}

    public function eventName()
    {
        return 'joined';
    }

    public function data()
    {
        return $this->user;
    }
}