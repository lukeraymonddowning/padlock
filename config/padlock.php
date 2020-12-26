<?php

use Lukeraymonddowning\Padlock\Features;
use Lukeraymonddowning\Padlock\Password\HaveIBeenPwned;

return [
    'features' => [
        Features::recordInsecurePasswordHashes()
    ],

    'default' => 'haveibeenpwned',

    'providers' => [
        'haveibeenpwned' => [
            'driver' => HaveIBeenPwned::class,
            'key' => env('HAVE_I_BEEN_PWNED_KEY')
        ]
    ],
];