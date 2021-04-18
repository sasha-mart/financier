<?php

declare(strict_types=1);

namespace App\Service\Parser;

interface ParserStrategyInterface
{
    public function initReader(string $filePath): void;

    public function parseFile(\DateTimeInterface $dateFrom, \DateTimeInterface $dateTo): void;
}
