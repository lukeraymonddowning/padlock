<?php


namespace Lukeraymonddowning\Padlock;


class Features
{
    protected static function has($feature)
    {
        return in_array($feature, config('padlock.features'));
    }

    public static function recordInsecurePasswordHashes()
    {
        return 'record-insecure-password-hashes';
    }

    public static function shouldRecordInsecurePasswordHashes()
    {
        return static::has(static::recordInsecurePasswordHashes());
    }
}