<?php

namespace Domain\Support;

use Symfony\Component\Uid\Ulid;

abstract readonly class UlidTrait
{
    private function __construct(
        private readonly Ulid $ulid
    )
    {

    }

    public static function make(): self
    {
        return new static(new Ulid());
    }

    public function __toString(): string
    {
        return (string) $this->ulid;
    }

    /**
     * @param static $ulid
     */
    public function equals(mixed $ulid): bool
    {
        return $this->ulid->equals($ulid->ulid);
    }

    public static function fromString(string $ulid): self
    {
        return new static(new Ulid($ulid));
    }
}
