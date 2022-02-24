<?php

declare(strict_types=1);

namespace Lukeraymonddowning\Padlock\Facades;

use Illuminate\Support\Facades\Facade;
use Lukeraymonddowning\Padlock\Password\PasswordLookup;

/**
 * @method static PasswordLookup check($password)
 * @method static Padlock afterFindingInsecurePassword(callable $hook)
 */
final class Padlock extends Facade
{

    protected static function getFacadeAccessor(): string
    {
        return 'padlock';
    }

}