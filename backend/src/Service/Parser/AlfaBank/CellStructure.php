<?php

declare(strict_types=1);

namespace App\Service\Parser\AlfaBank;

use App\Service\Parser\AbstractCellStructure;

class CellStructure extends AbstractCellStructure
{
    protected function getCellDescription(): array
    {
        return [
            '"Дата"' => [
                'builder' => 'transaction',
                'method' => 'setDatetime',
            ],
            'Тип' => [
                'builder' => 'category',
                'method' => 'setType',
            ],
            'Категория' => [
                'builder' => 'category',
                'method' => 'setName',
            ],
            'Сумма' => [
                'builder' => 'transaction',
                'method' => 'setAmount',
            ],
            'Описание' => [
                'builder' => 'transaction',
                'method' => 'setDescription',
            ],
        ];
    }
}
