<?php
declare(strict_types=1);

namespace App\Service\Parser;

use App\Entity\Category;
use App\Entity\Transaction;

abstract class AbstractTransactionBuilder
{
    protected Transaction $transaction;

    public function reset()
    {
        $this->transaction = new Transaction();
    }

    abstract public function setDatetime(string $datetime): void;

    abstract public function setAmount(string $amount): void;

    abstract public function setDescription(string $description): void;

    public function getTransaction(): Transaction
    {
        return $this->transaction;
    }
}