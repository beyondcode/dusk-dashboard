<?php

namespace BeyondCode\DuskDashboard;

class Action
{
    protected $name;

    protected $arguments;

    protected $html;

    protected $previousHtml;

    protected $path;

    public function __construct(string $name, array $arguments, string $html, string $path)
    {
        $this->name = $name;

        $this->arguments = $arguments;

        $this->html = $html;

        $this->path = $path;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getHtml()
    {
        return $this->html;
    }

    public function setPreviousHtml(?string $html)
    {
        $this->previousHtml = $html;
    }

    public function getPreviousHtml()
    {
        return $this->previousHtml;
    }

    public function getArguments()
    {
        return $this->arguments;
    }

    public function getPath()
    {
        return $this->path;
    }
}
