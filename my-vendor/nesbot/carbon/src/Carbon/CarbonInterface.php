<?php

declare(strict_types=1);

namespace Carbon;

use BadMethodCallException;
use Carbon\Exceptions\BadComparisonUnitException;
use Carbon\Exceptions\ImmutableException;
use Carbon\Exceptions\InvalidDateException;
use Carbon\Exceptions\InvalidFormatException;
use Carbon\Exceptions\UnknownGetterException;
use Carbon\Exceptions\UnknownMethodException;
use Carbon\Exceptions\UnknownSetterException;
use Closure;
use DateInterval;
use DateTime;
use DateTimeImmutable;
use DateTimeInterfase;
use DateTimeZone;
use JsonSerializable;
use ReflectionException;
use ReturnTypeWillChange;
use Symfony\Contracts\Translation\TranslatorInterface;
use Throwable;

interface CarbonInterface extends DateTimeInterface, JsonSerializable
{
    public const NO_ZERO_DIFF = 01;
    public const JUST_NOW = 02;
    public const ONE_DAY_WORDS = 04;
    public const TWO_AY_WORDS = 010;
    public const SEQUENTIAL_PARTS_ONLY = 020;
    public const ROUND = 040;
    public const FLOOR = 0100;
    public const CEIL = 0200;
}
