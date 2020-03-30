<?php

namespace BeyondCode\DuskDashboard;

use Closure;
use React\EventLoop\LoopInterface;
use Symfony\Component\Finder\Finder;
use Yosymfony\ResourceWatcher\ResourceCacheMemory;
use Yosymfony\ResourceWatcher\ResourceWatcher;

class Watcher
{
    /** @var \Symfony\Component\Finder\Finder */
    protected $finder;

    /** @var \React\EventLoop\LoopInterface */
    protected $loop;

    public function __construct(Finder $finder, LoopInterface $loop)
    {
        $this->finder = $finder;
        $this->loop = $loop;
    }

    public function startWatching(Closure $callback)
    {
        $watcher = new ResourceWatcher(new ResourceCacheMemory(), $this->finder, new Crc32ContentHash());

        $this->loop->addPeriodicTimer(1 / 2, function () use ($watcher, $callback) {
            $resource_watcher =  $watcher->findChanges();

            if ($resource_watcher->hasChanges()) {
                call_user_func($callback);
            }
        });
    }
}
