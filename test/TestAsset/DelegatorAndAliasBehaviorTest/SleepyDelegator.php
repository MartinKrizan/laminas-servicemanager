<?php

declare(strict_types=1);

namespace LaminasTest\ServiceManager\TestAsset\DelegatorAndAliasBehaviorTest;

use Swoole\Coroutine;

final class SleepyDelegator
{
    public function __invoke(): self
    {
        Coroutine::sleep(1);

        return new self();
    }
}
