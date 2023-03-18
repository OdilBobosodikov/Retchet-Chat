<?php

namespace RetchetApp\Events;

class UserLeft extends Event
{
    public function __construct(protected $user)
    {}

    public function eventName()
    {
        return 'left';
    }

    public function data()
    {
        return $this->user;
    }
}