<?php

declare(strict_types=1);

namespace LaminasTest\ServiceManager\TestAsset;

use Laminas\ServiceManager\Attributes\ServiceAlias;
use Laminas\ServiceManager\Factory\FactoryInterface;

class ClassWithServiceAliasAttribute
{
    public function __construct(
        #[ServiceAlias(SampleFactory::class)]
        public FactoryInterface $factory
    ) {
    }
}
