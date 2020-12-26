<?php

namespace Lukeraymonddowning\Padlock\Tests;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Lukeraymonddowning\Padlock\Providers\PadlockServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [PadlockServiceProvider::class];
    }

    protected function setUp(): void
    {
        parent::setUp();

        Http::fake(['https://api.pwnedpasswords.com/range/*' => function(Request $request) {
            $hash = Str::after($request->url(), "/range/");
            return Http::response(file_get_contents(__DIR__ . "/fakes/$hash.txt"));
        }]);
    }
}