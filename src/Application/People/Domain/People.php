<?php

namespace Src\Application\People\Domain;

use Src\Shared\Domain\Domain;

final class People extends Domain
{
    protected function isException(?string $exception): void
    {
    }

    public function handle(): array
    {
        return parent::entity();
    }
}
