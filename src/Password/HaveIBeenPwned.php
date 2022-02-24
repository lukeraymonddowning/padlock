<?php

declare(strict_types=1);

namespace Lukeraymonddowning\Padlock\Password;

use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Lukeraymonddowning\Padlock\Contracts\Sentry;

final class HaveIBeenPwned implements Sentry
{
    public function __construct(private PendingRequest $request)
    {
    }

    public function isSecure(string $password): bool
    {
        $hash = Str::upper(sha1(utf8_encode($password)));

        return ! Str::contains($this->makeRequest($hash), substr($hash, 5));
    }

    private function makeRequest(string $hash): string
    {
        return $this
            ->request
            ->get("https://api.pwnedpasswords.com/range/" . substr($hash, 0, 5))
            ->body();
    }
}