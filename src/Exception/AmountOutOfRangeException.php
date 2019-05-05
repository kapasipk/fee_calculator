<?php

declare(strict_types=1);

namespace Lendable\Interview\Interpolation\Exception;

/**
 * Class AmountOutOfRangeException
 *
 * @package Lendable\Interview\Interpolation\Exception
 */
class AmountOutOfRangeException extends BadRequestException
{
    /**
     * AmountOutOfRangeException constructor.
     *
     * @param float $loanAmount
     */
    public function __construct(float $loanAmount)
    {
        parent::__construct('The loan amount ' . $loanAmount . ' is out of the term range defined');
    }
}
