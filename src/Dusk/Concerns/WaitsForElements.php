<?php

namespace BeyondCode\DuskDashboard\Dusk\Concerns;

use Closure;

trait WaitsForElements
{
    /** {@inheritdoc} */
    public function whenAvailable($selector, Closure $callback, $seconds = null)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return parent::whenAvailable($selector, $callback, $seconds);
    }

    /** {@inheritdoc} */
    public function waitFor($selector, $seconds = null)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return parent::waitFor($selector, $seconds);
    }

    /** {@inheritdoc} */
    public function waitUntilMissing($selector, $seconds = null)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return parent::waitUntilMissing($selector, $seconds);
    }

    /** {@inheritdoc} */
    public function waitForText($text, $seconds = null)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return parent::waitForText($text, $seconds);
    }

    /** {@inheritdoc} */
    public function waitForLink($link, $seconds = null)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return parent::waitForLink($link, $seconds);
    }

    /** {@inheritdoc} */
    public function waitForLocation($path, $seconds = null)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return parent::waitForLocation($path, $seconds);
    }

    /** {@inheritdoc} */
    public function waitForRoute($route, $parameters = [], $seconds = null)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return parent::waitForRoute($route, $parameters, $seconds);
    }

    /** {@inheritdoc} */
    public function waitUntil($script, $seconds = null, $message = null)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return parent::waitUntil($script, $seconds, $message);
    }

    /** {@inheritdoc} */
    public function waitForDialog($seconds = null)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return parent::waitForDialog($seconds);
    }

    /** {@inheritdoc} */
    public function waitForReload($callback = null, $seconds = null)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return parent::waitForReload($callback, $seconds);
    }

    /** {@inheritdoc} */
    public function waitUsing($seconds, $interval, Closure $callback, $message = null)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return parent::waitUsing($seconds, $interval, $callback, $message);
    }
}
