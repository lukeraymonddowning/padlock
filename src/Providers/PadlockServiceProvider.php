<?php

declare(strict_types=1);

namespace Lukeraymonddowning\Padlock\Providers;

use App\Models\InsecurePasswordHash;
use Illuminate\Support\ServiceProvider;
use Lukeraymonddowning\Padlock\Contracts\Sentry;
use Lukeraymonddowning\Padlock\Facades\Padlock as PadlockFacade;
use Lukeraymonddowning\Padlock\Features;
use Lukeraymonddowning\Padlock\Padlock;

final class PadlockServiceProvider extends ServiceProvider
{
    public array $singletons = [
        'padlock' => Padlock::class,
    ];

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/padlock.php', 'padlock');

        $provider = config('padlock.default');
        $this->app->bind(Sentry::class, config("padlock.providers.{$provider}.driver"));
    }

    public function boot(): void
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