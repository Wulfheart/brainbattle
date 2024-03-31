<?php

namespace Core\Domain\Question;

final readonly class Category
{
    public function __construct(
        public CategoryId $id,
        public string $name,
    ) {
    }
}
