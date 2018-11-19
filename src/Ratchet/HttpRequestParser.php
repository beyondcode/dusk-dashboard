<?php

namespace BeyondCode\DuskDashboard\Ratchet;

/**
 * Unfortunately there is no easier way to set a custom max size for the request parser...
 */
class HttpRequestParser extends \Ratchet\Http\HttpRequestParser
{
    public $maxSize = 5242880;
}
