<?php

namespace RetchetApp\Events;

class Users extends Event
{
    public function __construct(protected array $users)
    {
    }

    public function eventName()
    {
        return 'users';
    }

    public function data()
    {
        return array_values($this->users);
    }
}