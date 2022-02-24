<?php

declare(strict_types=1);

namespace Lukeraymonddowning\Padlock;

use Lukeraymonddowning\Padlock\Password\PasswordLookup;

final class Padlock
{
    private array $hooks = [
        'afterFindingInsecurePassword' => []
    ];

    public function check(string $password): PasswordLookup
    {
        return app(PasswordLookup::class, ['password' => $password]);
    }

    public function afterFindingInsecurePassword(callable $hook): self
    {
        $this->hooks['afterFindingInsecurePassword'][] = $hook;

        return $this;
    }

    public function insecurePasswordFound(string $password): void
    {
        collect($this->hooks['afterFindingInsecurePassword'])->each->__invoke($password);
    }
}