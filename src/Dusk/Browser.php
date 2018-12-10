<?php

namespace BeyondCode\DuskDashboard\Dusk;

use Laravel\Dusk\Browser as BaseBrowser;
use BeyondCode\DuskDashboard\BrowserActionCollector;

class Browser
{

    /** @var BaseBrowser */
    protected $browser;

    public function __construct(BaseBrowser $browser)
    {
        $this->browser = $browser;
    }

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

    protected function getCurrentPageSource()
    {
        $this->browser->ensurejQueryIsAvailable();

        $this->restoreHtml();

        return $this->browser->driver->executeScript('return document.documentElement.innerHTML;');
    }

    public function __call(string $name, array $arguments)
    {
        $previousState = $this->getCurrentPageSource();

        $result = call_user_func_array([$this->browser, $name], $arguments);

        $this->actionCollector->collect($name, $arguments, $this->getCurrentPageSource());

        return $result;
    }

    protected function restoreHtml()
    {
        $this->browser->driver->executeScript("$('input').attr('value', function() { return $(this).val(); });");

        $this->browser->driver->executeScript("$('input[type=checkbox]').each(function() { $(this).attr('checked', $(this).prop(\"checked\")); });");

        $this->browser->driver->executeScript("$('textarea').each(function() { $(this).html($(this).val()); });");

        $this->browser->driver->executeScript("$('input[type=radio]').each(function() { $(this).attr('checked', this.checked); });");

        $this->browser->driver->executeScript("$('select option').each(function() { $(this).attr('selected', this.selected); });");
    }
}
