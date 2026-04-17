<?php

declare(strict_types=1);

namespace LaminasTest\ServiceManager;

use DateTime;
use Laminas\ServiceManager\ServiceManager;
use LaminasTest\ServiceManager\TestAsset\DelegatorAndAliasBehaviorTest\SleepyDelegator;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Swoole\Coroutine;

final class ServiceManagerSwooleTest extends TestCase
{
    #[Test]
    public function delegatorsAreUsedOnParallelCall(): void
    {
        Coroutine\run(
            static function () use (&$first, &$second): void {
                $sm = new ServiceManager([
                    'delegators' => [
                        DateTime::class => [
                            SleepyDelegator::class => SleepyDelegator::class,
                        ],
                    ],
                    'invokables' => [
                        DateTime::class => DateTime::class,
                    ],
                ]);
                Coroutine::create(static function () use ($sm, &$first): void {
                    $first = $sm->get(DateTime::class);
                });
                Coroutine::create(static function () use ($sm, &$second): void {
                    $second = $sm->get(DateTime::class);
                });
            }
        );

        /** @phpstan-ignore-next-line  */
        self::assertInstanceOf(SleepyDelegator::class, $first, 'First failed');

        /** @phpstan-ignore-next-line  */
        self::assertInstanceOf(SleepyDelegator::class, $second, 'Second failed');
    }
}
