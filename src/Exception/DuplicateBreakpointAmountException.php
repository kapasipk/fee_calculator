<?php

declare(strict_types=1);

namespace Lendable\Interview\Interpolation\Exception;

use RuntimeException;

/**
 * Class DuplicateBreakpointAmountException
 *
 * @package Lendable\Interview\Interpolation\Exception
 */
class DuplicateBreakpointAmountException extends RuntimeException
{
    /**
     * DuplicateBreakpointAmountException constructor.
     *
     * @param float $amount
     */
    public function __construct(float $amount)
    {
        parent::__construct('Breakpoint with amount ' . $amount . ' already exists');
    }
}
