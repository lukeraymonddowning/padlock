<?php


namespace Lukeraymonddowning\Padlock;


use Lukeraymonddowning\Padlock\Password\PasswordLookup;

class Padlock
{
    protected $hooks = [
        'afterFindingInsecurePassword' => []
    ];

    public function check($password): PasswordLookup
    {
        return app(PasswordLookup::class, ['password' => $password]);
    }

    public function afterFindingInsecurePassword(callable $hook)
    {
        $this->hooks['afterFindingInsecurePassword'][] = $hook;

        return $this;
    }

    public function insecurePasswordFound($password)
    {
        collect($this->hooks['afterFindingInsecurePassword'])->each->__invoke($password);
    }
}