<?php


namespace Lukeraymonddowning\Padlock\Password;


use Lukeraymonddowning\Padlock\Contracts\Password;
use Lukeraymonddowning\Padlock\Facades\Padlock;

class PasswordLookup
{
    public function __construct(protected $password, protected Password $service)
    {
    }

    public function isSecure()
    {
        $secure = $this->service->isSecure($this->password);

        if (!$secure) {
            Padlock::insecurePasswordFound($this->password);
        }

        return $secure;
    }
}