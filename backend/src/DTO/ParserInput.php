<?php

declare(strict_types=1);

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class ParserInput
{
    /**
     * @var \DateTimeInterface
     * @Assert\Date()
     */
    private $dateFrom;

    /**
     * @var \DateTimeInterface
     * @Assert\Date()
     */
    private $dateTo;

    /**
     * @var string
     * @Assert\NotNull()
     */
    private $file;

    public function getDateFrom(): \DateTimeInterface
    {
        return $this->dateFrom;
    }

    public function getDateTo(): \DateTimeInterface
    {
        return $this->dateTo;
    }

    public function getFile(): string
    {
        return $this->file;
    }

    public function setDateFrom(\DateTimeInterface $dateFrom): void
    {
        $this->dateFrom = $dateFrom;
    }

    public function setDateTo(\DateTimeInterface $dateTo): void
    {
        $this->dateTo = $dateTo;
    }

    public function setFile(string $file): void
    {
        $this->file = $file;
    }
}
