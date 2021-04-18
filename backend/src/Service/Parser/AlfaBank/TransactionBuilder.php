<?php

declare(strict_types=1);

namespace App\Service\Parser\AlfaBank;

use App\Service\Parser\AbstractTransactionBuilder;
use DateTimeImmutable;

class TransactionBuilder extends AbstractTransactionBuilder
{
    public function setAmount(string $amount): void
    {
        $this->transaction->setAmount((float) $amount);
    }

    public function setDatetime(string $datetime): void
    {
        $this->transaction->setDatetime(DateTimeImmutable::createFromFormat('Y.m.d', $datetime));
    }

    public function setDescription(string $description): void
    {
        $this->transaction->setDescription($description);
    }
}
