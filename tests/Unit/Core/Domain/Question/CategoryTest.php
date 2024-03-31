<?php

namespace Tests\Unit\Core\Domain\Question;

use Core\Domain\Question\Category;
use Core\Domain\Question\CategoryId;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Category::class)]
class CategoryTest extends TestCase
{
    public function test_can_be_constructed(): void
    {
        $id = CategoryId::make();
        $category = new Category($id, '::NAME::');

        $this->assertSame($id, $category->id);
        $this->assertSame('::NAME::', $category->name);
    }
}
