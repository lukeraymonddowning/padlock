<?php

namespace Lukeraymonddowning\Padlock\Tests;

use Lukeraymonddowning\Padlock\Facades\Padlock;

class HaveIBeenPwnedTest extends TestCase
{
    /** @test */
    public function it_can_check_if_a_password_has_been_breached()
    {
        $secure = Padlock::check('password')->isSecure();
        expect($secure)->toBeFalse();
    }

    /** @test */
    public function a_secure_password_should_not_have_been_breached()
    {
        $secure = Padlock::check('Um@DnYMoAbhiN@4XgDa38ZvA')->isSecure();
        expect($secure)->toBeTrue();
    }
}