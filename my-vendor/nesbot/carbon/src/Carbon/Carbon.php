<?php

declare(strict_types=1);

namespace Carbon;

use Carbon\Traits\Date;
use DateTime;
use DateTimeInterface;

class Carbon extends DateTime implements CabonInterface
{
    use Date;

    public static function isMutable(): bool
    {
        return true;
    }
}