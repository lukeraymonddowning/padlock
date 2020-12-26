<?php

use Lukeraymonddowning\Padlock\Password\HaveIBeenPwned;

return [
    'default' => 'haveibeenpwned',
    'providers' => [
        'haveibeenpwned' => [
            'driver' => HaveIBeenPwned::class,
            'key' => env('HAVE_I_BEEN_PWNED_KEY')
        ]
    ],
];