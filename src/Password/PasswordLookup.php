<?php

declare(strict_types=1);

namespace Lukeraymonddowning\Padlock\Password;


use Lukeraymonddowning\Padlock\Contracts\Sentry;
use Lukeraymonddowning\Padlock\Facades\Padlock;

final class PasswordLookup
{
    public function __construct(protected string $password, protected Sentry $service)
    {
    }

    public function isSecure(): bool
    {
        if (! $secure = $this->service->isSecure($this->password)) {
            Padlock::insecurePasswordFound($this->password);
        }

        return $secure;
    }
}