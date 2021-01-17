<?php

namespace App\Enum;

class TransactionType
{
    const INCOME = 'income';
    const EXPENSE = 'expense';

    const AVAILABLE_TYPES = [
        self::INCOME,
        self::EXPENSE,
    ];
}