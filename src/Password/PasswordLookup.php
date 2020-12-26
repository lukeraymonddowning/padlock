<?php


namespace Lukeraymonddowning\Padlock\Password;


use Lukeraymonddowning\Padlock\Contracts\Password;

class PasswordLookup
{
    public function __construct(protected $password, protected Password $service)
    {
    }

    public function isSecure()
    {
        return $this->service->isSecure($this->password);
    }
}