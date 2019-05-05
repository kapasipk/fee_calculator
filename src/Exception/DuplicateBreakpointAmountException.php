<?php

declare(strict_types=1);

namespace Lendable\Interview\Interpolation\Exception;

use RuntimeException;

class DuplicateBreakpointAmountException extends RuntimeException
{
    public function __construct(float $amount)
    {
        parent::__construct('Breakpoint with amount ' . $amount . ' already exists');
    }
}
