<?php


namespace Lukeraymonddowning\Padlock\Password;


use Http;
use Illuminate\Support\Str;
use Lukeraymonddowning\Padlock\Contracts\Bouncer;

class HaveIBeenPwned implements Bouncer
{
    protected $hash;

    public function isSecure($password): bool
    {
        $this->hash = Str::upper(sha1(utf8_encode($password)));
        return !Str::contains($this->makeRequest(), $this->hashSuffix());
    }

    protected function makeRequest()
    {
        return Http::get("https://api.pwnedpasswords.com/range/" . $this->hashPrefix())->body();
    }

    protected function hashPrefix()
    {
        return Str::limit($this->hash, 5, "");
    }

    protected function hashSuffix()
    {
        return Str::after($this->hash, $this->hashPrefix());
    }
}