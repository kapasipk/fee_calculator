<?php

namespace Lendable\Interview\Interpolation\InterpolationStrategy;

use Lendable\Interview\Interpolation\Model\Term;

class Linear implements InterpolationStrategyInterface
{
    public function calculate(Term $term, float $loanAmount): float
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
            throw new \LogicException();
        }

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
}
