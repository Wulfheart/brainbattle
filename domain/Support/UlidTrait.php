<?php

namespace Domain\Support;

use Symfony\Component\Uid\Ulid;

trait UlidTrait
{
    private function __construct(
        private readonly Ulid $ulid
    )
    {

    }

    public static function make(): self
    {
        return new self(new Ulid());
    }

    public function __toString(): string
    {
        return (string) $this->ulid;
    }

    public function equals(self $ulid): bool
    {
        return $this->ulid->equals($ulid->ulid);
    }

    public static function fromString(string $ulid): self
    {
        return new self(new Ulid($ulid));
    }
}
