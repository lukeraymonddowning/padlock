<?php

namespace Lukeraymonddowning\Padlock\Tests;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Lukeraymonddowning\Padlock\Providers\PadlockServiceProvider;
use Lukeraymonddowning\Padlock\Tests\Doubles\Http\TestPendingRequest;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->migrations();
    }

    public function getTestRequest(): PendingRequest
    {
        return new TestPendingRequest(new Factory($this->app->make(Dispatcher::class)));
    }

    protected function getPackageProviders($app): array
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

    protected static function usingDatabase(): bool
    {
        return in_array(RefreshDatabase::class, class_uses_recursive(static::class));
    }

    protected function migrations(): void
    {
        if (!static::usingDatabase()) {
            return;
        }

        $this->loadMigrationsFrom(__DIR__ . '/../stubs/migrations');
    }
}