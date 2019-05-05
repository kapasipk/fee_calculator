<?php

declare(strict_types=1);

namespace Lendable\Interview\Interpolation\InterpolationStrategy;

use Lendable\Interview\Interpolation\Exception;
use Lendable\Interview\Interpolation\Model\Term;

/**
 * Class Linear
 *
 * @package Lendable\Interview\Interpolation\InterpolationStrategy
 */
class Linear implements InterpolationStrategyInterface
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
    public function calculate(Term $term, float $loanAmount): float
    {
        foreach ($term->getBreakpoints() as $breakpoint)
        {
            $breakpointAmt = $breakpoint->getAmount();

            // If there exists a direct breakpoint for that particular amount,
            // use the fee directly instead of interpolating
            if ($breakpointAmt === $loanAmount)
            {
                return $breakpoint->getFee();
            }
        }

        [$minBreakpoint, $maxBreakpoint] = $this->extractMinMaxBreakpoints($term, $loanAmount);

        //
        // Linear Interpolation Y for a point X which lies between the points
        // x0 and x1 which have the y values set as y0 and y1 respectively.
        //
        // x0 => y0
        // x1 => y1
        // X  => Y
        //
        //            (X - x0) * (y1 - y0)
        //  Y = y0 +  ____________________      [Y = Base + Delta]
        //
        //                  (x1 - x0)
        //

        $baseFee  = $minBreakpoint->getFee();

        // (X - x0) / (x1 - x0)
        $deltaFee = ($loanAmount - $minBreakpoint->getAmount()) / ($maxBreakpoint->getAmount() - $minBreakpoint->getAmount());

        // ((X - x0) / (x1 - x0)) * (y1 - y0)
        $deltaFee = $deltaFee * ($maxBreakpoint->getFee() - $minBreakpoint->getFee());

        $fee   = $baseFee + $deltaFee;
        $total = $loanAmount + $fee;

        // Round up total to the nearest 5
        $total = ceil($total/5) * 5;

        // Adjust fee so that amount + fee is an exact multiple of 5
        $fee = round($total - $loanAmount,2);

        return $fee;
    }

    /**
     * Extracts the 2 min and max breakpoints surrounding the loan amount.
     * These breakpoints will then be used to calculate the fees.
     *
     * For eg:
     * For breakpoints - [1000, 2000, 4000, 8000, 16000] and loan amount as 5000,
     * the output will point to 4000 and 8000 as the min and max breakpoints.
     *
     * @param Term  $term
     * @param float $loanAmount
     *
     * @return array
     * @throws Exception\AmountOutOfRangeException
     */
    private function extractMinMaxBreakpoints(Term $term, float $loanAmount): array
    {
        $minBreakpoint = $maxBreakpoint = null;

        foreach ($term->getBreakpoints() as $breakpoint)
        {
            $breakpointAmt = $breakpoint->getAmount();

            // If there exists a direct breakpoint for that particular amount,
            // use the fee directly instead of interpolating
            if ($breakpointAmt === $loanAmount)
            {
                return $breakpoint->getFee();
            }

            if (($breakpointAmt < $loanAmount) &&
                (is_null($minBreakpoint) or ($minBreakpoint->getAmount() < $breakpointAmt)))
            {
                $minBreakpoint = $breakpoint;
            }

            if (($loanAmount < $breakpointAmt) &&
                (is_null($maxBreakpoint) or ($breakpointAmt < $maxBreakpoint->getAmount())))
            {
                $maxBreakpoint = $breakpoint;
            }
        }

        if (($minBreakpoint === null) or ($maxBreakpoint === null))
        {
            throw new Exception\AmountOutOfRangeException($loanAmount);
        }

        return [$minBreakpoint, $maxBreakpoint];
    }
}
