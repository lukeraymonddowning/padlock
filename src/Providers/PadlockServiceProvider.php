<?php

namespace Lukeraymonddowning\Padlock\Providers;


use Illuminate\Support\ServiceProvider;
use Lukeraymonddowning\Padlock\Contracts\Password;
use Lukeraymonddowning\Padlock\Padlock;

class PadlockServiceProvider extends ServiceProvider
{
    public $singletons = [
        'padlock' => Padlock::class,
    ];

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/padlock.php', 'padlock');

        $provider = config('padlock.default');
        $this->app->bind(Password::class, config("padlock.providers.$provider.driver"));
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes(
                [
                    __DIR__ . '/../../config/padlock.php' => config_path('padlock.php'),
                    __DIR__ . '/../../stubs/fakes' => storage_path('padlock/fakes'),
                ],
                'padlock'
            );
        }
    }
}