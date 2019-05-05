<?php

declare(strict_types=1);

namespace Lendable\Interview\Interpolation\InterpolationStrategy;

use Lendable\Interview\Interpolation\Exception;
use Lendable\Interview\Interpolation\Model\Term;

/**
 * Interface InterpolationStrategyInterface
 *
 * @package Lendable\Interview\Interpolation\InterpolationStrategy
 */
interface InterpolationStrategyInterface
{
    /**
     * Calculate the fees for a given term period and a loan amount.
     *
     * @param Term  $term
     * @param float $loanAmount
     *
     * @return float
     * @throws Exception\AmountOutOfRangeException
     */
    public function calculate(Term $term, float $loanAmount): float;
}
