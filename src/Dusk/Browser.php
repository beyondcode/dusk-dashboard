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
        $this->driver->executeScript("$('input').attr('value', function() { return $(this).val(); });");

        $this->driver->executeScript("$('input[type=checkbox]').each(function() { $(this).attr('checked', $(this).prop(\"checked\")); });");

        $this->driver->executeScript("$('textarea').each(function() { $(this).html($(this).val()); });");

        $this->driver->executeScript("$('input[type=radio]').each(function() { $(this).attr('checked', this.checked); });");

        $this->driver->executeScript("$('select option').each(function() { $(this).attr('selected', this.selected); });");
    }
}
