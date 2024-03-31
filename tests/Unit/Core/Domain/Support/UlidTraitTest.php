<?php

namespace Tests\Unit\Core\Domain\Support;

use Core\Domain\Support\UlidTrait;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Uid\Ulid;

#[CoversClass(UlidTrait::class)]
class UlidTraitTest extends TestCase
{
    public function test_make(): void
    {
        $ulid = SomeUlid::make();

        Ulid::fromString($ulid);
        $this->expectNotToPerformAssertions();
    }

    public function test_toString(): void
    {
        $ulid = SomeUlid::make();
        $this->assertEquals($ulid, (string) $ulid);
    }

    public function test_equals(): void
    {
        $ulid1 = SomeUlid::make();
        $ulid2 = SomeUlid::make();

        $this->assertTrue($ulid1->equals($ulid1));
        $this->assertFalse($ulid1->equals($ulid2));
    }

    public function test_fromString(): void
    {
        $ulid = SomeUlid::make();
        $this->assertEquals($ulid, (string) SomeUlid::fromString($ulid));
    }

}
