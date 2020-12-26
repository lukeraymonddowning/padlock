<?php


namespace Lukeraymonddowning\Padlock\Password;


use Http;
use Illuminate\Support\Str;
use Lukeraymonddowning\Padlock\Contracts\Bouncer;

class HaveIBeenPwned implements Bouncer
{
    const BASE_URL = "https://api.pwnedpasswords.com/range/";
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
        return static::client()->get(static::BASE_URL . $this->hashPrefix())->body();
    }

    protected static function client()
    {
        return Http::withHeaders(
            [
                'hibp-api-key' => config('padlock.providers.haveibeenpwned.key'),
                'user-agent' => config('app.name'),
            ]
        );
    }

    protected function hashPrefix()
    {
        return Str::limit($this->hash, 5, "");
    }
}