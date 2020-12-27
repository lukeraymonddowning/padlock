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
            'driver' => HaveIBeenPwned::class
        ]
    ],
];