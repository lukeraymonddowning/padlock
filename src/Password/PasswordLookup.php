<?php


namespace Lukeraymonddowning\Padlock\Password;


use Lukeraymonddowning\Padlock\Contracts\Bouncer;
use Lukeraymonddowning\Padlock\Facades\Padlock;

class PasswordLookup
{
    public function __construct(protected $password, protected Bouncer $service)
    {
    }

    public function isSecure()
    {
        if (!$secure = $this->service->isSecure($this->password)) {
            Padlock::insecurePasswordFound($this->password);
        }

        return $secure;
    }
}