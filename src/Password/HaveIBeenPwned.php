<?php


namespace Lukeraymonddowning\Padlock\Password;


use Http;
use Illuminate\Support\Str;
use Lukeraymonddowning\Padlock\Contracts\Sentry;

class HaveIBeenPwned implements Sentry
{
    protected $hash;

    public function isSecure($password): bool
    {
        $this->hash = Str::upper(sha1(utf8_encode($password)));
        return !Str::contains($this->makeRequest(), substr($this->hash, 5));
    }

    protected function makeRequest()
    {
        return Http::get("https://api.pwnedpasswords.com/range/" . substr($this->hash, 0, 5))->body();
    }
}