<?php

namespace App\Interface\IRepository;

interface IOTPRepository
{
    public function createOTP();
    public function deleteOTP();
    public function retrieveOTP();
}
