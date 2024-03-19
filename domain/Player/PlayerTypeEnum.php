<?php

namespace Domain\Player;

enum PlayerTypeEnum: string
{
    case INVITING = "INVITING";
    case INVITED = "INVITED";
}
