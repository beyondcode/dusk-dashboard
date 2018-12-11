<?php

namespace BeyondCode\DuskDashboard\Dusk\Concerns;

trait InteractsWithElements
{
    /** {@inheritdoc} */
    public function elements($selector)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this->getCurrentPageSource());

        return parent::elements($selector);
    }

    /** {@inheritdoc} */
    public function element($selector)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this->getCurrentPageSource());

        return parent::element($selector);
    }

    /** {@inheritdoc} */
    public function clickLink($link, $element = 'a')
    {
        $browser = parent::clickLink($link, $element);

        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this->getCurrentPageSource());

        return $browser;
    }

    /** {@inheritdoc} */
    public function value($selector, $value = null)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this->getCurrentPageSource());

        return parent::value($selector, $value);
    }

    /** {@inheritdoc} */
    public function text($selector)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this->getCurrentPageSource());

        return parent::text($selector);
    }

    /** {@inheritdoc} */
    public function attribute($selector, $attribute)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this->getCurrentPageSource());

        return parent::attribute($selector, $attribute);
    }

    /** {@inheritdoc} */
    public function keys($selector, ...$keys)
    {
        $browser = parent::keys($selector, $keys);

        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this->getCurrentPageSource());

        return $browser;
    }

    /** {@inheritdoc} */
    public function type($field, $value)
    {
        $browser = parent::type($field, $value);

        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this->getCurrentPageSource());

        return $browser;
    }

    /** {@inheritdoc} */
    public function append($field, $value)
    {
        $browser = parent::append($field, $value);

        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this->getCurrentPageSource());

        return $browser;
    }

    /** {@inheritdoc} */
    public function clear($field)
    {
        $browser = parent::clear($field);

        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this->getCurrentPageSource());

        return $browser;
    }

    /** {@inheritdoc} */
    public function select($field, $value = null)
    {
        $browser = parent::select($field, $value);

        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this->getCurrentPageSource());

        return $browser;
    }

    /** {@inheritdoc} */
    public function radio($field, $value)
    {
        $browser = parent::radio($field, $value);

        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this->getCurrentPageSource());

        return $browser;
    }

    /** {@inheritdoc} */
    public function check($field, $value = null)
    {
        $browser = parent::check($field, $value);

        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this->getCurrentPageSource());

        return $browser;
    }

    /** {@inheritdoc} */
    public function uncheck($field, $value = null)
    {
        $browser = parent::uncheck($field, $value);

        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this->getCurrentPageSource());

        return $browser;
    }

    /** {@inheritdoc} */
    public function attach($field, $path)
    {
        $browser = parent::attach($field, $path);

        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this->getCurrentPageSource());

        return $browser;
    }

    /** {@inheritdoc} */
    public function press($button)
    {
        $browser = parent::press($button);

        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this->getCurrentPageSource());

        return $browser;
    }

    /** {@inheritdoc} */
    public function pressAndWaitFor($button, $seconds = 5)
    {
        $browser = parent::pressAndWaitFor($button, $seconds);

        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this->getCurrentPageSource());

        return $browser;
    }

    /** {@inheritdoc} */
    public function drag($from, $to)
    {
        $browser = parent::drag($from, $to);

        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this->getCurrentPageSource());

        return $browser;
    }

    /** {@inheritdoc} */
    public function dragUp($selector, $offset)
    {
        $browser = parent::dragUp($selector, $offset);

        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this->getCurrentPageSource());

        return $browser;
    }

    /** {@inheritdoc} */
    public function dragDown($selector, $offset)
    {
        $browser = parent::dragDown($selector, $offset);

        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this->getCurrentPageSource());

        return $browser;
    }

    /** {@inheritdoc} */
    public function dragLeft($selector, $offset)
    {
        $browser = parent::dragLeft($selector, $offset);

        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this->getCurrentPageSource());

        return $browser;
    }

    /** {@inheritdoc} */
    public function dragRight($selector, $offset)
    {
        $browser = parent::dragRight($selector, $offset);

        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this->getCurrentPageSource());

        return $browser;
    }

    /** {@inheritdoc} */
    public function dragOffset($selector, $x = 0, $y = 0)
    {
        $browser = parent::dragOffset($selector, $x, $y);

        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this->getCurrentPageSource());

        return $browser;
    }

    /** {@inheritdoc} */
    public function acceptDialog()
    {
        $browser = parent::acceptDialog();

        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this->getCurrentPageSource());

        return $browser;
    }

    /** {@inheritdoc} */
    public function typeInDialog($value)
    {
        $browser = parent::typeInDialog($value);

        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this->getCurrentPageSource());

        return $browser;
    }

    /** {@inheritdoc} */
    public function dismissDialog()
    {
        $browser = parent::dismissDialog();

        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this->getCurrentPageSource());

        return $browser;
    }
}
