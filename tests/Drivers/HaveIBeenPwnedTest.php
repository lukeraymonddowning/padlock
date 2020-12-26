<?php


namespace Lukeraymonddowning\Padlock\Tests\Drivers;


use Lukeraymonddowning\Padlock\Password\HaveIBeenPwned;
use Lukeraymonddowning\Padlock\Tests\TestCase;

class HaveIBeenPwnedTest extends TestCase
{
    /** @test */
    public function it_can_check_if_a_password_has_been_breached()
    {
        $instance = new HaveIBeenPwned();
        $secure = $instance->isSecure('password');
        expect($secure)->toBeFalse();
    }

    /** @test */
    public function a_secure_password_should_not_have_been_breached()
    {
        $instance = new HaveIBeenPwned();
        $secure = $instance->isSecure('Um@DnYMoAbhiN@4XgDa38ZvA');
        expect($secure)->toBeTrue();
    }
}