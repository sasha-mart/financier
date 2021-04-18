<?php

declare(strict_types=1);

namespace App\Tests\Unit\Service\Parser\AlfaBank;

use App\Repository\CategoryRepository;
use App\Service\Parser\AlfaBank\CategoryBuilder;
use App\Service\Parser\Exception\LogicException;
use PHPUnit\Framework\TestCase;

class CategoryBuilderTest extends TestCase
{
    public function getPositiveTypes(): array
    {
        return [
            ['Расход', 'expense'],
            ['Доход', 'income'],
        ];
    }

    /**
     * @dataProvider getPositiveTypes
     */
    public function testSetTypePositive(string $input, string $value): void
    {
        $categoryRepository = $this->createMock(CategoryRepository::class);
        $categoryBuilder = new CategoryBuilder($categoryRepository);
        $categoryBuilder->reset();
        $categoryBuilder->setType($input);

        $this->assertEquals($value, $categoryBuilder->getCategory()->getType());
    }

    public function testSetTypeNegative()
    {
        $this->expectException(LogicException::class);

        $categoryRepository = $this->createMock(CategoryRepository::class);
        $categoryBuilder = new CategoryBuilder($categoryRepository);
        $categoryBuilder->reset();
        $categoryBuilder->setType('some_type');
    }
}