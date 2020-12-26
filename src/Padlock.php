<?php


namespace Lukeraymonddowning\Padlock;


use Lukeraymonddowning\Padlock\Password\PasswordLookup;

class Padlock
{
    public function check($password): PasswordLookup
    {
        return app(PasswordLookup::class, ['password' => $password]);
    }
}