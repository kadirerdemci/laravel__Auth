<?php

namespace App\Interfaces;

use App\Core\ServiceResponse;

interface IUserService
{
    public function register(
         string $name,
         string $email,
         string $password
    ):ServiceResponse;

    public function login(
        string $email,
        string $password
    ):ServiceResponse;


}
