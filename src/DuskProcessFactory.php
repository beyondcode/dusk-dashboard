<?php

namespace BeyondCode\DuskDashboard;

use Symfony\Component\Process\Process;

class DuskProcessFactory
{
    /**
     * Create new process to run Dusk, passing the same arguments Dashboard command received.
     *
     * @return \Symfony\Component\Process\Process
     */
    public static function make()
    {
        return new Process(array_merge(self::binary(), self::arguments()), base_path());
    }

    /**
     * Dusk command represented as array.
     *
     * @return array
     */
    protected static function binary()
    {
        return [PHP_BINARY, 'artisan', 'dusk'];
    }

    /**
     * Arguments that were given to dusk:dashboard.
     *
     * @return array
     */
    protected static function arguments()
    {
        return array_slice($_SERVER['argv'], 2);
    }
}
