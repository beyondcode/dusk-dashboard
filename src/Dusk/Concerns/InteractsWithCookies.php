<?php

namespace BeyondCode\DuskDashboard\Dusk\Concerns;

trait InteractsWithCookies
{
    /** {@inheritdoc} */
    public function cookie($name, $value = null, $expiry = null, array $options = [])
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return parent::cookie($name, $value, $expiry, $options);
    }

    /** {@inheritdoc} */
    public function plainCookie($name, $value = null, $expiry = null, array $options = [])
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return parent::plainCookie($name, $value, $expiry, $options);
    }

    /** {@inheritdoc} */
    public function addCookie($name, $value, $expiry = null, array $options = [], $encrypt = true)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return parent::addCookie($name, $value, $expiry, $options, $encrypt);
    }

    /** {@inheritdoc} */
    public function deleteCookie($name)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return parent::deleteCookie($name);
    }
}
