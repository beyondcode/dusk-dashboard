<?php

namespace BeyondCode\DuskDashboard\Dusk\Concerns;

trait InteractsWithMouse
{
    /** {@inheritdoc} */
    public function moveMouse($xOffset, $yOffset)
    {
        $previousHtml = $this->getCurrentPageSource();

        $browser = parent::moveMouse($xOffset, $yOffset);

        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this, $previousHtml);

        return $browser;
    }

    /** {@inheritdoc} */
    public function mouseover($selector)
    {
        $previousHtml = $this->getCurrentPageSource();

        $browser = parent::mouseover($selector);

        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this, $previousHtml);

        return $browser;
    }

    /** {@inheritdoc} */
    public function click($selector = null)
    {
        $previousHtml = $this->getCurrentPageSource();

        $browser = parent::click($selector);

        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this, $previousHtml);

        return $browser;
    }

    /** {@inheritdoc} */
    public function clickAndHold()
    {
        $previousHtml = $this->getCurrentPageSource();

        $browser = parent::clickAndHold();

        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this, $previousHtml);

        return $browser;
    }

    public function doubleClick()
    {
        $previousHtml = $this->getCurrentPageSource();

        $browser = parent::doubleClick();

        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this, $previousHtml);

        return $browser;
    }

    /** {@inheritdoc} */
    public function rightClick($selector = null)
    {
        $previousHtml = $this->getCurrentPageSource();

        $browser = parent::rightClick($selector);

        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this, $previousHtml);

        return $browser;
    }

    /** {@inheritdoc} */
    public function releaseMouse()
    {
        $previousHtml = $this->getCurrentPageSource();

        $browser = parent::releaseMouse();

        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this, $previousHtml);

        return $browser;
    }
}
