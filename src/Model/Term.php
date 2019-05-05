<?php

declare(strict_types=1);

namespace Lendable\Interview\Interpolation\Model;

use Lendable\Interview\Interpolation\Exception;

/**
 * Class Term
 *
 * @package Lendable\Interview\Interpolation\Model
 */
class Term
{
    /**
     * @var int
     */
    private $noOfMonths = 0;

    /**
     * @var array
     */
    private $breakpoints = [];

    /**
     * Term constructor.
     *
     * @param int $noOfMonths
     *
     * @throws Exception\DuplicateBreakpointAmountException
     */
    public function __construct(int $noOfMonths)
    {
        $this->setNoOfMonths($noOfMonths);

        $this->generateBreakpointsFromData();
    }

    /**
     * Loads the data, generates the breakpoint objects and adds them to the term.
     *
     * @throws Exception\DuplicateBreakpointAmountException
     */
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

    /**
     * Validates and adds the breakpoint to the term
     *
     * @param Breakpoint $breakpoint
     *
     * @throws Exception\DuplicateBreakpointAmountException
     */
    public function addBreakpoint(Breakpoint $breakpoint)
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

    /**
     * @param Breakpoint $newBreakpoint
     *
     * @throws Exception\DuplicateBreakpointAmountException
     */
    private function validateAddBreakpoint(Breakpoint $newBreakpoint)
    {
        $termBreakpoints = $this->getBreakpoints();

        foreach ($termBreakpoints as $breakpoint)
        {
            if ($breakpoint->getAmount() === $newBreakpoint->getAmount())
            {
                throw new Exception\DuplicateBreakpointAmountException($breakpoint->getAmount());
            }
        }
    }
}
