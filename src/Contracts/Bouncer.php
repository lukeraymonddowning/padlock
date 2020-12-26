<?php


namespace Lukeraymonddowning\Padlock\Contracts;


interface Bouncer
{
    public function isSecure($password): bool;
}