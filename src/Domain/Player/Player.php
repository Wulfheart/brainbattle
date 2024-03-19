<?php

namespace Core\Domain\Player;

final readonly class Player
{
    public function __construct(
        public PlayerId $id,
        public string $name,
        public PlayerTypeEnum $type,
    ) {

    }

    public function equals(Player $player): bool
    {
        if (! $this->id->equals($player->id)) {
            return false;
        }
        if ($this->name !== $player->name) {
            return false;
        }
        if ($this->type !== $player->type) {
            return false;
        }

        return true;
    }
}
