<?php

declare(strict_types=1);

namespace Lukeraymonddowning\Padlock\Contracts;


interface Sentry
{
    public function isSecure(string $password): bool;
}