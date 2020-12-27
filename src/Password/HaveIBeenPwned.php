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
        $this->hash = sha1(utf8_encode($password));
        return !$this->formattedResults()->contains(Str::lower($this->hash));
    }

    protected function formattedResults()
    {
        return collect(preg_split('/\n|\r\n?/', $this->makeRequest()))
            ->map(fn($result) => Str::before($result, ":"))
            ->map(fn($suffix) => $this->hashPrefix() . $suffix)
            ->map(fn($hash) => Str::lower($hash));
    }

    protected function makeRequest()
    {
        return Http::get("https://api.pwnedpasswords.com/range/" . $this->hashPrefix())->body();
    }

    protected function hashPrefix()
    {
        return Str::limit($this->hash, 5, "");
    }
}