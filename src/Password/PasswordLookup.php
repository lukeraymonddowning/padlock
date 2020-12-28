<?php


namespace Lukeraymonddowning\Padlock\Password;


use Lukeraymonddowning\Padlock\Contracts\Sentry;
use Lukeraymonddowning\Padlock\Facades\Padlock;

class PasswordLookup
{
    public function __construct(protected $password, protected Sentry $service)
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