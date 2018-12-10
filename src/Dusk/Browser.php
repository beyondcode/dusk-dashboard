<?php

namespace BeyondCode\DuskDashboard\Dusk;

use BeyondCode\DuskDashboard\BrowserActionCollector;
use Laravel\Dusk\Browser as BaseBrowser;

class Browser extends BaseBrowser
{
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

    /**
     * {@inheritdoc}
     */
    public function visit($url)
    {
        $browser = parent::visit($url);
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $browser->getCurrentPageSource());

        return $browser;
    }

    /**
     * {@inheritdoc}
     */
    public function login()
    {
        $browser = parent::login();
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $browser->getCurrentPageSource());

        return $browser;
    }

    /**
     * {@inheritdoc}
     */
    public function type($field, $value)
    {
        $browser = parent::type($field, $value);
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $browser->getCurrentPageSource());

        return $browser;
    }

    /**
     * {@inheritdoc}
     */
    public function click($selector = null)
    {
        $browser = parent::click($selector);
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $browser->getCurrentPageSource());

        return $browser;
    }

    /**
     * {@inheritdoc}
     */
    public function press($button)
    {
        $browser = parent::press($button);
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $browser->getCurrentPageSource());

        return $browser;
    }

    /**
     * {@inheritdoc}
     */
    public function check($field, $value = null)
    {
        $browser = parent::check($field, $value);
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $browser->getCurrentPageSource());

        return $browser;
    }

    /**
     * {@inheritdoc}
     */
    public function select($field, $value = null)
    {
        $browser = parent::select($field, $value);
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $browser->getCurrentPageSource());

        return $browser;
    }

    /**
     * {@inheritdoc}
     */
    public function radio($field, $value)
    {
        $browser = parent::radio($field, $value);
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $browser->getCurrentPageSource());

        return $browser;
    }

    /**
     * {@inheritdoc}
     */
    public function assertSeeIn($selector, $text)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this->getCurrentPageSource());

        return parent::assertSeeIn($selector, $text);
    }

    /**
     * {@inheritdoc}
     */
    public function assertPathIs($path)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this->getCurrentPageSource());

        return parent::assertPathIs($path);
    }

    /**
     * {@inheritdoc}
     */
    public function mouseover($selector)
    {
        $browser = parent::mouseover($selector);
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this->getCurrentPageSource());

        return $browser;
    }

    protected function getCurrentPageSource()
    {
        $this->ensurejQueryIsAvailable();
        /*
         * Modify inputs and textareas so that their HTML reflects the current values
         */
        $this->driver->executeScript("$('input').attr('value', function() { return $(this).val(); });");
        $this->driver->executeScript("$('input[type=checkbox]').each(function() { $(this).attr('checked', $(this).prop(\"checked\")); });");
        $this->driver->executeScript("$('textarea').each(function() { $(this).html($(this).val()); });");
        $this->driver->executeScript("$('input[type=radio]').each(function() { $(this).attr('checked', this.checked); });");
        $this->driver->executeScript("$('select option').each(function() { $(this).attr('selected', this.selected); });");

        return $this->driver->executeScript('return document.documentElement.innerHTML;');
    }
}
