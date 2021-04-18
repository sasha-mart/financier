<?php

namespace App\Enum;

class TransactionType
{
    const AVAILABLE_TYPES = [
        self::INCOME,
        self::EXPENSE,
    ];

    const EXPENSE = 'expense';

    const INCOME = 'income';
}
