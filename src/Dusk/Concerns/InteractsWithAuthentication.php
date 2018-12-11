<?php

namespace BeyondCode\DuskDashboard\Dusk\Concerns;

trait InteractsWithAuthentication
{
    /** {@inheritdoc} */
    public function login()
    {
        $browser = parent::login();

        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return $browser;
    }

    /** {@inheritdoc} */
    public function loginAs($userId, $guard = null)
    {
        $browser = parent::loginAs($userId, $guard);

        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return $browser;
    }

    /** {@inheritdoc} */
    public function logout($guard = null)
    {
        $browser = parent::logout($guard);

        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return $browser;
    }

    /** {@inheritdoc} */
    public function assertAuthenticated($guard = null)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return parent::assertAuthenticated($guard);
    }

    /** {@inheritdoc} */
    public function assertGuest($guard = null)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return parent::assertGuest($guard);
    }

    /** {@inheritdoc} */
    public function assertAuthenticatedAs($user, $guard = null)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return parent::assertAuthenticatedAs($user, $guard);
    }
}
