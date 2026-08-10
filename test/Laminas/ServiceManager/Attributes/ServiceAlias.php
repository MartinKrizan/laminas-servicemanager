<?php

declare(strict_types=1);

namespace Laminas\ServiceManager\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PARAMETER)]
final readonly class ServiceAlias
{
    public function __construct(
        string $serviceName
    ) {
    }
}
