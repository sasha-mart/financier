<?php
declare(strict_types=1);

namespace App\Service\Parser;

use App\Service\Parser\AlfaBank\CategoryBuilder;
use App\Service\Parser\AlfaBank\CellStructure;
use App\Service\Parser\AlfaBank\TransactionBuilder;
use App\Service\Parser\Exception\LogicException;

/**
 * Structure of cells index with appropriate properties of Transaction.
 */
abstract class AbstractCellStructure
{
    private array $structure;

    protected AbstractTransactionBuilder $transactionBuilder;

    protected AbstractCategoryBuilder $categoryBuilder;

    public function __construct(
        AbstractTransactionBuilder $transactionBuilder,
        AbstractCategoryBuilder $categoryBuilder
    ) {
        $this->transactionBuilder = $transactionBuilder;
        $this->categoryBuilder = $categoryBuilder;
        $this->structure = $this->getCellDescription();
    }

    public function addCellDescription(int $cellIndex, string $cellTitle): void
    {
        if (!isset($this->structure[$cellTitle])) {
            throw new LogicException('Cannot found such index in cells structure: '.$cellTitle);
        }

        $this->structure[$cellIndex] = $this->structure[$cellTitle];
        unset($this->structure[$cellTitle]);
    }

    public function hasColumnName(string $columnName): bool
    {
        return isset($this->structure[$columnName]);
    }

    public function hasIndex(int $columnIndex): bool
    {
        return isset($this->structure[$columnIndex]);
    }

    /**
     * @return AbstractCategoryBuilder|AbstractTransactionBuilder
     */
    public function getBuilder(int $cellIndex)
    {
        if (!isset($this->structure[$cellIndex]['builder'])) {
            throw new LogicException('Cannot found specific builder for transaction in cells structure.');
        }

        switch ($this->structure[$cellIndex]['builder']) {
            case 'transaction':
                return $this->transactionBuilder;
            case 'category':
                return $this->categoryBuilder;
            default:
                throw new LogicException('Incorrect builder in cells structure.');
        }
    }

    public function getMethod(int $cellIndex): string
    {
        if (!isset($this->structure[$cellIndex]['method'])) {
            throw new LogicException('Cannot found specific builder for transaction in cells structure.');
        }

        return $this->structure[$cellIndex]['method'];
    }

    /**
     * @return array Array with description of cells, format:
     *  [
     *      'ColumnTitle' => [
     *          'builder' => 'transaction/category/etc',
     *          'method' => 'setField',
     *      ],
     *      ...
     *   ],
     */
    abstract protected function getCellDescription(): array;
}