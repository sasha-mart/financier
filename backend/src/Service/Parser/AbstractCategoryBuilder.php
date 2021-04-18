<?php

declare(strict_types=1);

namespace App\Service\Parser;

use App\Entity\Category;
use App\Repository\CategoryRepository;

abstract class AbstractCategoryBuilder
{
    protected Category $category;

    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getCategory(): Category
    {
        $existCategory = $this->categoryRepository->findOneBy([
            'type' => $this->category->getType(),
            'name' => $this->category->getName(),
        ]);

        return null !== $existCategory ? $existCategory : $this->category;
    }

    public function reset(): void
    {
        $this->category = new Category();
    }

    abstract public function setName(string $name): void;

    abstract public function setType(string $type): void;
}
