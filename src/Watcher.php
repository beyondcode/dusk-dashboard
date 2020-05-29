<?php

namespace BeyondCode\DuskDashboard;

use Closure;
use React\EventLoop\LoopInterface;
use Symfony\Component\Finder\Finder;
use Yosymfony\ResourceWatcher\Crc32ContentHash;
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
        $hashContent = new Crc32ContentHash();
        $watcher = new ResourceWatcher(new ResourceCacheMemory(), $this->finder, $hashContent);

        $this->loop->addPeriodicTimer(1 / 2, function () use ($watcher, $callback) {
            $watcher_result = $watcher->findChanges();

            if ($watcher_result->hasChanges()) {
                call_user_func($callback);
            }
        });
    }
}
