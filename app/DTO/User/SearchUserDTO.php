<?php

namespace App\DTO\User;

class SearchUserDTO
{
    public function __construct(public readonly ?string $keyword = null)
    {}
}
