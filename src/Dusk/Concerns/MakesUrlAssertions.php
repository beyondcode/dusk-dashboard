<?php

namespace BeyondCode\DuskDashboard\Dusk\Concerns;

trait MakesUrlAssertions
{
    /** @inheritdoc */
    public function assertUrlIs($url)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this->getCurrentPageSource());

        return parent::assertUrlIs($url);
    }

    /** @inheritdoc */
    public function assertSchemeIs($scheme)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this->getCurrentPageSource());

        return parent::assertSchemeIs($scheme);
    }

    /** @inheritdoc */
    public function assertSchemeIsNot($scheme)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this->getCurrentPageSource());

        return parent::assertSchemeIsNot($scheme);
    }

    /** @inheritdoc */
    public function assertHostIs($host)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this->getCurrentPageSource());

        return parent::assertHostIs($host);
    }

    /** @inheritdoc */
    public function assertHostIsNot($host)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this->getCurrentPageSource());

        return parent::assertHostIsNot($host);
    }

    /** @inheritdoc */
    public function assertPortIs($port)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this->getCurrentPageSource());

        return parent::assertPortIs($port);
    }

    /** @inheritdoc */
    public function assertPortIsNot($port)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this->getCurrentPageSource());

        return parent::assertPortIsNot($port);
    }

    /** @inheritdoc */
    public function assertPathIs($path)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this->getCurrentPageSource());

        return parent::assertPathIs($path);
    }

    /** @inheritdoc */
    public function assertPathBeginsWith($path)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this->getCurrentPageSource());

        return parent::assertPathBeginsWith($path);
    }

    /** @inheritdoc */
    public function assertPathIsNot($path)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this->getCurrentPageSource());

        return parent::assertPathIsNot($path);
    }

    /** @inheritdoc */
    public function assertFragmentIs($fragment)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this->getCurrentPageSource());

        return parent::assertFragmentIs($fragment);
    }

    /** @inheritdoc */
    public function assertFragmentBeginsWith($fragment)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this->getCurrentPageSource());

        return parent::assertFragmentBeginsWith($fragment);
    }

    /** @inheritdoc */
    public function assertFragmentIsNot($fragment)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this->getCurrentPageSource());

        return parent::assertFragmentIsNot($fragment);
    }

    /** @inheritdoc */
    public function assertRouteIs($route, $parameters = [])
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this->getCurrentPageSource());

        return parent::assertRouteIs($route, $parameters);
    }

    /** @inheritdoc */
    public function assertQueryStringHas($name, $value = null)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this->getCurrentPageSource());

        return parent::assertQueryStringHas($name, $value);
    }

    /** @inheritdoc */
    public function assertQueryStringMissing($name)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this->getCurrentPageSource());

        return parent::assertQueryStringMissing($name);
    }

    /** @inheritdoc */
    protected function assertHasQueryStringParameter($name)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this->getCurrentPageSource());

        return parent::assertHasQueryStringParameter($name);
    }
}