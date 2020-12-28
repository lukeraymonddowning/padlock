<?php


namespace Lukeraymonddowning\Padlock\Contracts;


interface Sentry
{
    public function isSecure($password): bool;
}