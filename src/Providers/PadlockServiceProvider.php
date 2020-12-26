<?php

namespace Lukeraymonddowning\Padlock\Providers;


use App\Models\InsecurePasswordHash;
use Illuminate\Support\ServiceProvider;
use Lukeraymonddowning\Padlock\Contracts\Bouncer;
use Lukeraymonddowning\Padlock\Facades\Padlock as PadlockFacade;
use Lukeraymonddowning\Padlock\Features;
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
        $this->app->bind(Bouncer::class, config("padlock.providers.$provider.driver"));
    }

    public function boot()
    {
        if (Features::shouldRecordInsecurePasswordHashes()) {
            PadlockFacade::afterFindingInsecurePassword(
                fn($password) => InsecurePasswordHash::firstOrCreate(['hash' => sha1(utf8_encode($password))])
            );
        }

        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__ . '/../../config/padlock.php' => config_path('padlock.php')], 'padlock');
        }
    }
}