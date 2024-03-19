<?php

namespace Domain\Question;

final readonly class Category
{
    public function __construct(
        private CategoryId $id,
    ) {
    }
}
