<?php


namespace Lukeraymonddowning\Padlock\Tests;


use App\Models\InsecurePasswordHash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Lukeraymonddowning\Padlock\Facades\Padlock;

class InsecurePasswordHashHookTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function after_finding_an_insecure_password_it_is_stored_in_the_insecure_password_hash_table()
    {
        expect(InsecurePasswordHash::all())->toBeEmpty();
        Padlock::check('password')->isSecure();
        expect(InsecurePasswordHash::all())->toHaveCount(1);
    }

    /** @test */
    public function if_a_matching_hash_already_exists_it_is_not_reinserted()
    {
        Padlock::check('password')->isSecure();
        Padlock::check('password')->isSecure();
        expect(InsecurePasswordHash::all())->toHaveCount(1);
    }
}