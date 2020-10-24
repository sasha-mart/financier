<?php
declare(strict_types=1);

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class ParserInput
{
    /**
     * @var string
     * @Assert\NotNull()
     */
    private $file;

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
     * @return string
     */
    public function getFile(): string
    {
        return $this->file;
    }

    /**
     * @param string $file
     */
    public function setFile(string $file): void
    {
        $this->file = $file;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getDateFrom(): \DateTimeInterface
    {
        return $this->dateFrom;
    }

    /**
     * @param \DateTimeInterface $dateFrom
     */
    public function setDateFrom(\DateTimeInterface $dateFrom): void
    {
        $this->dateFrom = $dateFrom;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getDateTo(): \DateTimeInterface
    {
        return $this->dateTo;
    }

    /**
     * @param \DateTimeInterface $dateTo
     */
    public function setDateTo(\DateTimeInterface $dateTo): void
    {
        $this->dateTo = $dateTo;
    }
}