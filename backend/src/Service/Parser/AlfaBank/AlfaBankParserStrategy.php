<?php

declare(strict_types=1);

namespace App\Service\Parser\AlfaBank;

use App\Entity\Transaction;
use App\Service\Parser\ParserStrategyInterface;
use Box\Spout\Common\Entity\Row;
use Box\Spout\Common\Exception\IOException;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Box\Spout\Reader\CSV\Sheet;
use Box\Spout\Reader\ReaderInterface;
use Doctrine\ORM\EntityManagerInterface;

class AlfaBankParserStrategy implements ParserStrategyInterface
{
    private CategoryBuilder $categoryBuilder;

    private CellStructure $cellStructure;

    private EntityManagerInterface $entityManager;

    /**
     * @var ReaderInterface
     */
    private $reader;

    private TransactionBuilder $transactionBuilder;

    public function __construct(
        TransactionBuilder $transactionBuilder,
        CategoryBuilder $categoryBuilder,
        CellStructure $cellStructure,
        EntityManagerInterface $entityManager
    ) {
        $this->transactionBuilder = $transactionBuilder;
        $this->categoryBuilder = $categoryBuilder;
        $this->entityManager = $entityManager;
        $this->cellStructure = $cellStructure;
    }

    /**
     * @return $this
     *
     * @throws IOException
     */
    public function initReader(string $filePath): void
    {
        $reader = ReaderEntityFactory::createCSVReader();
        $reader->setFieldDelimiter(';');
        $reader->setFieldEnclosure('"');
        $reader->open($filePath);

        $this->reader = $reader;
    }

    public function parseFile(\DateTimeInterface $dateFrom, \DateTimeInterface $dateTo): void
    {
        /** @var Sheet $sheet */
        $sheet = $this->reader->getSheetIterator()->current();
        $sheet->getRowIterator()->next();
        $this->setCellsStructure($sheet->getRowIterator()->current());
        $sheet->getRowIterator()->next();

        /* @var Row $row */
        while ($sheet->getRowIterator()->valid()) {
            $transaction = $this->getTransactionFromRow($sheet->getRowIterator()->current());

            if ($transaction->isBetweenDates($dateFrom, $dateTo)) {
                // TODO bulk inserts
                $this->entityManager->persist($transaction);
                $this->entityManager->flush();
            }

            $sheet->getRowIterator()->next();
        }

        $this->reader->close();
    }

    private function cleanZeroWidthSpace(string $string): string
    {
        return preg_replace('/[\x{200B}-\x{200D}\x{FEFF}]/u', '', $string);
    }

    private function getTransactionFromRow(Row $row): Transaction
    {
        $this->transactionBuilder->reset();
        $this->categoryBuilder->reset();

        foreach ($row->getCells() as $cellIndex => $cell) {
            if (false === $this->cellStructure->hasIndex($cellIndex)) {
                continue;
            }

            $builder = $this->cellStructure->getBuilder($cellIndex);
            $method = $this->cellStructure->getMethod($cellIndex);

            $builder->$method($cell->getValue());
        }
        $category = $this->categoryBuilder->getCategory();
        $transaction = $this->transactionBuilder->getTransaction();
        $transaction->setCategory($category);

        return $transaction;
    }

    private function setCellsStructure(Row $firstRow): void
    {
        foreach ($firstRow->getCells() as $cellIndex => $cell) {
            $columnName = $this->cleanZeroWidthSpace($cell->getValue());
            if (false === is_string($columnName)) {
                continue;
            }

            if (false === $this->cellStructure->hasColumnName($columnName)) {
                continue;
            }

            $this->cellStructure->addCellDescription($cellIndex, $columnName);
        }
    }
}
