<?php

declare(strict_types=1);

namespace CodeblogPro\GeoCoder\Providers;

class Google implements ProviderInterface
{
    public function getName(): string
    {
        return get_class($this);
    }
}