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
        $browser = parent::clickAndHold();

        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return $browser;
    }

    public function doubleClick()
    {
        $browser = parent::doubleClick();

        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return $browser;
    }

    /** {@inheritdoc} */
    public function rightClick($selector = null)
    {
        $browser = parent::rightClick($selector);

        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return $browser;
    }

    /** {@inheritdoc} */
    public function releaseMouse()
    {
        $browser = parent::releaseMouse();

        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return $browser;
    }
}
