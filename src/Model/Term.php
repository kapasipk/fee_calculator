<?php

declare(strict_types=1);

namespace Lendable\Interview\Interpolation\Model;

use Lendable\Interview\Interpolation\Exception;

class Term
{
    private $noOfMonths = 0;

    private $breakpoints = [];

    public function __construct(int $noOfMonths)
    {
        $this->setNoOfMonths($noOfMonths);

        $this->generateBreakpointsFromData();
    }

    private function generateBreakpointsFromData()
    {
        $className     = __NAMESPACE__;
        $className     = substr($className, 0, strrpos($className, "\\"));
        $termClassName = $className . '\\TermData\\Term' . $this->getNoOfMonths();

        if (class_exists($termClassName) === false)
        {
            throw new Exception\InvalidTermException($this->getNoOfMonths());
        }

        $breakpointsData = (new $termClassName)->getData();

        foreach ($breakpointsData as $breakpointData)
        {
            $breakpoint = new Breakpoint($breakpointData);

            $this->addBreakpoint($breakpoint);
        }
    }

    /**
     * @return array
     */
    public function getBreakpoints(): array
    {
        return $this->breakpoints;
    }

    private function addBreakpoint(Breakpoint $breakpoint)
    {
        $this->validateAddBreakpoint($breakpoint);

        $this->breakpoints[] = $breakpoint;
    }

    /**
     * @return int
     */
    public function getNoOfMonths(): int
    {
        return $this->noOfMonths;
    }

    /**
     * @param int $noOfMonths
     */
    public function setNoOfMonths(int $noOfMonths)
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
