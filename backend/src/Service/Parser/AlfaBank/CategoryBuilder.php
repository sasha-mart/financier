<?php
declare(strict_types=1);

namespace App\Service\Parser\AlfaBank;

use App\Enum\TransactionType;
use App\Service\Parser\AbstractCategoryBuilder;
use App\Service\Parser\Exception\LogicException;

class CategoryBuilder extends AbstractCategoryBuilder
{

    public function setType(string $type): void
    {
        switch ($type) {
            case 'Расход':
                $this->category->setType(TransactionType::EXPENSE);
                break;
            case 'Доход':
                $this->category->setType(TransactionType::INCOME);
                break;
            default:
                throw new LogicException('Incorrect transaction type.');
        }
    }

    public function setName(string $name): void
    {
        $this->category->setName($name);
    }
}