<?php

declare(strict_types=1);

namespace Lendable\Interview\Interpolation\Exception;

use RuntimeException;

class MissingBreakpointAttributesException extends RuntimeException
{
    public function __construct(array $breakpointData)
    {
        parent::__construct('Required breakpoint attributes are missing.');
    }
}
