<?php

namespace Lukeraymonddowning\Padlock\Facades;

use Illuminate\Support\Facades\Facade;
use Lukeraymonddowning\Padlock\Password\PasswordLookup;

/**
 * @method static PasswordLookup check($password)
 */
class Padlock extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'padlock';
    }

}