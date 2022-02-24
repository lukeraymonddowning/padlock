<?php

namespace Lukeraymonddowning\Padlock\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Client\PendingRequest;
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

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testing');

        if (!static::usingDatabase()) {
            $app['config']->set('padlock.features', []);
        }
    }

    protected static function usingDatabase()
    {
        return in_array(RefreshDatabase::class, class_uses_recursive(static::class));
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->migrations();
        
//        Http::fake(
//            [
//                'https://api.pwnedpasswords.com/range/*' => function (Request $request) {
//                    $hash = Str::after($request->url(), "/range/");
//                    return Http::response(file_get_contents(__DIR__ . "/fakes/$hash.txt"));
//                }
//            ]
//        );
    }

    protected function migrations()
    {
        if (!static::usingDatabase()) {
            return;
        }

        $this->loadMigrationsFrom(__DIR__ . '/../stubs/migrations');
    }
}