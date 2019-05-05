<?php

declare(strict_types=1);

namespace Lendable\Interview\Interpolation\Tests\Unit;

use Lendable\Interview\Interpolation\Exception;
use Lendable\Interview\Interpolation\Model\Term;
use Lendable\Interview\Interpolation\Model\Breakpoint;
use Lendable\Interview\Interpolation\TermData\Constants;

/**
 * Class TermTest
 */
class TermTest extends Base
{
    /**
     * Asserts that duplicate breakpoint exception is thrown if a new breakpoint with the same amount is added
     */
    public function testAddingDuplicateBreakpoint()
    {
        $exceptionData = [
            'class'   => Exception\DuplicateBreakpointAmountException::class,
            'message' => 'Breakpoint with amount 1000 already exists',
        ];

        $this->runUnderExceptionHandler(function ()
        {
            $term = new Term(12);

            $data = [Constants::AMOUNT => 1000, Constants::FEE => 100];

            $breakpoint = new Breakpoint($data);

            $term->addBreakpoint($breakpoint);

            $term->addBreakpoint($breakpoint);
        }, $exceptionData);
    }
}
