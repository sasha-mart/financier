<?php
declare(strict_types=1);

namespace App\Service\Parser;

class Base64Parser implements ParserInterface
{
    private ParserStrategyInterface $strategy;

    private $tmpFile;

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
        $content = base64_decode($base64);
        $this->tmpFile = tmpfile();
        fwrite($this->tmpFile, $content);

        $this->strategy->initReader(stream_get_meta_data($this->tmpFile)['uri']);
        $this->strategy->parseFile($dateFrom, $dateTo);
    }

    public function __destruct()
    {
        fclose($this->tmpFile);
    }
}