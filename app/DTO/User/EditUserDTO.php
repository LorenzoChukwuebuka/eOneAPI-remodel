<?php

namespace App\DTO\User;

class EditUserDto 
{
    public function __construct(public string $firstName, public string $lastName, public  ? string $email = null, public int $id)
    {

    }

}