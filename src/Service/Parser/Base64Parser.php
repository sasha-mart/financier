<?php
declare(strict_types=1);

namespace App\Service\Parser;

class Base64Parser implements ParserInterface
{
    private const TEMP_DIRECTORY = './../../../var/reports/';

    private ParserStrategyInterface $strategy;

    /**
     * @param ParserStrategyInterface $strategy
     * @return ParserInterface
     */
    public function setStrategy(ParserStrategyInterface $strategy): ParserInterface
    {
        $this->strategy = $strategy;

        return $this;
    }

    public function parseReport(string $base64, \DateTimeInterface $dateFrom, \DateTimeInterface $dateTo): void
    {
        $filePath = self::TEMP_DIRECTORY.uniqid();
        $file = fopen($filePath, 'wb');
        $data = explode(',', $base64);
        fwrite($file, base64_decode($data[1]));
        fclose($file);

        $this->strategy->initReader($filePath);
        $this->strategy->parseFile($dateFrom, $dateTo);
    }
}