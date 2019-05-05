<?php

declare(strict_types=1);

namespace Lendable\Interview\Interpolation\Exception;

use RuntimeException;

/**
 * Class MissingBreakpointAttributesException
 *
 * @package Lendable\Interview\Interpolation\Exception
 */
class MissingBreakpointAttributesException extends RuntimeException
{
    /**
     * MissingBreakpointAttributesException constructor.
     *
     * @param array $breakpointData
     */
    public function __construct(array $breakpointData)
    {
        parent::__construct('Required breakpoint attributes are missing.');
    }
}
