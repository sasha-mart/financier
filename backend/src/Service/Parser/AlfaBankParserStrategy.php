<?php
declare(strict_types=1);

namespace App\Service\Parser;

use App\Entity\Transaction;
use Box\Spout\Common\Entity\Row;
use Box\Spout\Common\Exception\IOException;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Box\Spout\Reader\CSV\Sheet;
use Box\Spout\Reader\ReaderInterface;

class AlfaBankParserStrategy implements ParserStrategyInterface
{
    private const COLUMN_NAMES = [
        'Дата' => [
            'field' => 'datetime',
        ],
        'Тип' => [
            'field' => 'category.type',
        ],
        'Категория' => [
            'field' => 'category.name',
        ],
        'Сумма' => [
            'field' => 'amount',
        ],
        'Описание' => [
            'field' => 'description',
        ],
    ];

    /**
     * @var ReaderInterface
     */
    private $reader;

    /**
     * @param string $filePath
     * @return $this
     * @throws IOException
     */
    public function initReader(string $filePath): self
    {
        $reader = ReaderEntityFactory::createCSVReader();
        $reader->open($filePath);
        $reader->setFieldDelimiter(';');
        $reader->setFieldEnclosure('"');

        $this->reader = $reader;

        return $this;
    }

    public function parseFile(\DateTimeInterface $dateFrom, \DateTimeInterface $dateTo): void
    {
        /** @var Sheet $sheet */
        $sheet = $this->reader->getSheetIterator()->current();

        /** @var Row $row */
        foreach ($sheet->getRowIterator() as $row) {
            $rowsArray = $row->toArray();
            $transaction = new Transaction();
        }
    }


}