<?php

declare(strict_types=1);

namespace Lukeraymonddowning\Padlock;


final class Features
{
    private static function has($feature): bool
    {
        return in_array($feature, config('padlock.features'));
    }

    public static function recordInsecurePasswordHashes(): string
    {
        return 'record-insecure-password-hashes';
    }

    public static function shouldRecordInsecurePasswordHashes(): bool
    {
        return self::has(self::recordInsecurePasswordHashes());
    }
}