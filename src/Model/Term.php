<?php

declare(strict_types=1);

namespace Lendable\Interview\Interpolation\Model;

use Lendable\Interview\Interpolation\Exception;

class Term
{
    private $noOfMonths;

    private $breakpoints = [];

    /**
     * @return array
     */
    public function getBreakpoints(): array
    {
        return $this->breakpoints;
    }

    public function addBreakpoint(Breakpoint $breakpoint)
    {
        $this->validateAddBreakpoint($breakpoint);

        $this->breakpoints[] = $breakpoint;
    }

    /**
     * @return mixed
     */
    public function getNoOfMonths()
    {
        return $this->noOfMonths;
    }

    /**
     * @param mixed $noOfMonths
     */
    public function setNoOfMonths($noOfMonths)
    {
        $this->noOfMonths = $noOfMonths;
    }

    private function validateAddBreakpoint(Breakpoint $newBreakpoint)
    {
        $termBreakpoints = $this->getBreakpoints();

        foreach ($termBreakpoints as $breakpoint)
        {
            if ($breakpoint->getAmount() === $newBreakpoint->getAmount())
            {
                throw new Exception\DuplicateBreakpointAmountException($breakpoint, $newBreakpoint);
            }
        }
    }
}
