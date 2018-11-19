<?php

namespace BeyondCode\DuskDashboard;

class Action
{
    protected $name;
    protected $arguments;
    protected $html;

    public function __construct($name, $arguments, $html)
    {
        $this->name = $name;
        $this->arguments = $arguments;
        $this->html = $html;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getHtml()
    {
        return $this->html;
    }

    public function getArguments()
    {
        return $this->arguments;
    }
}
