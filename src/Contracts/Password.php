<?php


namespace Lukeraymonddowning\Padlock\Contracts;


interface Password
{
    public function isSecure($password): bool;
}