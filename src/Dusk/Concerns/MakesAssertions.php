<?php

namespace BeyondCode\DuskDashboard\Dusk\Concerns;

trait MakesAssertions
{
    /** {@inheritdoc} */
    public function assertTitle($title)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return parent::assertTitle($title);
    }

    /** {@inheritdoc} */
    public function assertTitleContains($title)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return parent::assertTitleContains($title);
    }

    /** {@inheritdoc} */
    public function assertHasCookie($name, $decrypt = true)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return parent::assertHasCookie($name, $decrypt);
    }

    /** {@inheritdoc} */
    public function assertHasPlainCookie($name)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return parent::assertHasPlainCookie($name);
    }

    /** {@inheritdoc} */
    public function assertCookieMissing($name, $decrypt = true)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return parent::assertCookieMissing($name, $decrypt);
    }

    /** {@inheritdoc} */
    public function assertPlainCookieMissing($name)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return parent::assertPlainCookieMissing($name);
    }

    /** {@inheritdoc} */
    public function assertCookieValue($name, $value, $decrypt = true)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return parent::assertCookieValue($name, $value, $decrypt);
    }

    /** {@inheritdoc} */
    public function assertPlainCookieValue($name, $value)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return parent::assertPlainCookieValue($name, $value);
    }

    /** {@inheritdoc} */
    public function assertSee($text)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return parent::assertSee($text);
    }

    /** {@inheritdoc} */
    public function assertSeeIn($selector, $text)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return parent::assertSeeIn($selector, $text);
    }

    /** {@inheritdoc} */
    public function assertDontSeeIn($selector, $text)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return parent::assertDontSeeLink($selector, $text);
    }

    /** {@inheritdoc} */
    public function assertSourceHas($code)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return parent::assertSourceHas($code);
    }

    /** {@inheritdoc} */
    public function assertSourceMissing($code)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return parent::assertSourceMissing($code);
    }

    /** {@inheritdoc} */
    public function assertSeeLink($link)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return parent::assertSeeLink($link);
    }

    /** {@inheritdoc} */
    public function assertDontSeeLink($link)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return parent::assertDontSeeLink($link);
    }

    /** {@inheritdoc} */
    public function seeLink($link)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return parent::seeLink($link);
    }

    /** {@inheritdoc} */
    public function assertInputValue($field, $value)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return parent::assertInputValue($field, $value);
    }

    /** {@inheritdoc} */
    public function assertInputValueIsNot($field, $value)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return parent::assertInputValueIsNot($field, $value);
    }

    /** {@inheritdoc} */
    public function inputValue($field)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return parent::inputValue($field);
    }

    /** {@inheritdoc} */
    public function assertChecked($field, $value = null)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return parent::assertChecked($field, $value);
    }

    /** {@inheritdoc} */
    public function assertNotChecked($field, $value = null)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return parent::assertNotChecked($field, $value);
    }

    /** {@inheritdoc} */
    public function assertRadioSelected($field, $value)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return parent::assertRadioSelected($field, $value);
    }

    /** {@inheritdoc} */
    public function assertRadioNotSelected($field, $value = null)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return parent::assertRadioNotSelected($field, $value);
    }

    /** {@inheritdoc} */
    public function assertSelected($field, $value)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return parent::assertSelectHasOption($field, $value);
    }

    /** {@inheritdoc} */
    public function assertNotSelected($field, $value)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return parent::assertNotSelected($field, $value);
    }

    /** {@inheritdoc} */
    public function assertSelectHasOptions($field, array $values)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return parent::assertSelectHasOptions($field, $values);
    }

    /** {@inheritdoc} */
    public function assertSelectMissingOptions($field, array $values)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return parent::assertSelectMissingOptions($field, $values);
    }

    /** {@inheritdoc} */
    public function assertSelectHasOption($field, $value)
    {
        return $this->assertSelectHasOptions($field, [$value]);
    }

    /** {@inheritdoc} */
    public function assertSelectMissingOption($field, $value)
    {
        return $this->assertSelectMissingOptions($field, [$value]);
    }

    /** {@inheritdoc} */
    public function selected($field, $value)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return parent::select($field, $value);
    }

    /** {@inheritdoc} */
    public function assertValue($selector, $value)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return parent::assertValue($field, $value);
    }

    /** {@inheritdoc} */
    public function assertVisible($selector)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return parent::assertVisible($selector);
    }

    /** {@inheritdoc} */
    public function assertPresent($selector)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return parent::assertPresent($selector);
    }

    /** {@inheritdoc} */
    public function assertMissing($selector)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return parent::assertMissing($selector);
    }

    /** {@inheritdoc} */
    public function assertDialogOpened($message)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return parent::assertDialogOpened($message);
    }

    /** {@inheritdoc} */
    public function assertEnabled($field)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return parent::assertEnabled($field);
    }

    /** {@inheritdoc} */
    public function assertDisabled($field)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return parent::assertDisabled($field);
    }

    /** {@inheritdoc} */
    public function assertFocused($field)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return parent::assertFocused($field);
    }

    /** {@inheritdoc} */
    public function assertNotFocused($field)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return parent::assertNotFocused($field);
    }

    /** {@inheritdoc} */
    public function assertVue($key, $value, $componentSelector = null)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return parent::assertVue($key, $value, $componentSelector);
    }

    /** {@inheritdoc} */
    public function assertVueIsNot($key, $value, $componentSelector = null)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return parent::assertVueIsNot($key, $value, $componentSelector);
    }

    /** {@inheritdoc} */
    public function assertVueContains($key, $value, $componentSelector = null)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return parent::assertVueContains($key, $value, $componentSelector);
    }

    /** {@inheritdoc} */
    public function assertVueDoesNotContain($key, $value, $componentSelector = null)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return parent::assertVueDoesNotContain($key, $value, $componentSelector);
    }

    /** {@inheritdoc} */
    public function vueAttribute($componentSelector, $key)
    {
        $this->actionCollector->collect(__FUNCTION__, func_get_args(), $this);

        return parent::vueAttribute($componentSelector, $key);
    }
}
