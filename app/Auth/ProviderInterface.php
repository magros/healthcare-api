<?php
namespace App\Auth;
interface ProviderInterface
{
    public function user();

    public function login();

}
