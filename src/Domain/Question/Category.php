<?php

namespace Core\Domain\Question;

final readonly class Category
{
    public function __construct(
        private CategoryId $id,
    ) {
    }
}
