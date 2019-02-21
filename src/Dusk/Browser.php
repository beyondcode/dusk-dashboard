<?php

namespace BeyondCode\DuskDashboard\Dusk;

use BeyondCode\DuskDashboard\BrowserActionCollector;

class Browser extends \Laravel\Dusk\Browser
{
    use Concerns\InteractsWithAuthentication,
        Concerns\InteractsWithCookies,
        Concerns\InteractsWithElements,
        Concerns\InteractsWithJavascript,
        Concerns\InteractsWithMouse,
        Concerns\MakesAssertions,
        Concerns\MakesUrlAssertions,
        Concerns\WaitsForElements;

    /** @var BrowserActionCollector */
    protected $actionCollector;

    public function setActionCollector(BrowserActionCollector $collector)
    {
        $this->actionCollector = $collector;
    }

    /**
     * @return BrowserActionCollector|null
     */
    public function getActionCollector()
    {
        return $this->actionCollector;
    }

    /** {@inheritdoc} */
    public function visit($url)
    {
        $browser = parent::visit($url);

        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return $browser;
    }

    /** {@inheritdoc} */
    public function visitRoute($route, $parameters = [])
    {
        $browser = parent::visitRoute($route, $parameters);

        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return $browser;
    }

    /** {@inheritdoc} */
    public function refresh()
    {
        $browser = parent::refresh();

        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return $browser;
    }

    public function getCurrentPageSource()
    {
        $this->ensurejQueryIsAvailable();

        $this->restoreHtml();

        return $this->driver->executeScript('return document.documentElement.innerHTML;');
    }

    protected function restoreHtml()
    {
        $this->driver->executeScript("jQuery('input').attr('value', function() { return jQuery(this).val(); });");

        $this->driver->executeScript("jQuery('input[type=checkbox]').each(function() { jQuery(this).attr('checked', jQuery(this).prop(\"checked\")); });");

        $this->driver->executeScript("jQuery('textarea').each(function() { jQuery(this).html(jQuery(this).val()); });");

        $this->driver->executeScript("jQuery('input[type=radio]').each(function() { jQuery(this).attr('checked', this.checked); });");

        $this->driver->executeScript("jQuery('select option').each(function() { jQuery(this).attr('selected', this.selected); });");
    }
}
