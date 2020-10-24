<?php
declare(strict_types=1);

namespace App\Service\Parser;

interface ParserInterface
{
    public function setStrategy(ParserStrategyInterface $strategy): ParserInterface;

    public function parseReport(string $file, \DateTimeInterface $dateFrom, \DateTimeInterface $dateTo): void;
}