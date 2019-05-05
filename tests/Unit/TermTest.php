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
    public function testAddingDuplicateBreakpoint()
    {
        try
        {
            $term = new Term(12);

            $data = [Constants::AMOUNT => 1000, Constants::FEE => 100];

            $breakpoint = new Breakpoint($data);

            $term->addBreakpoint($breakpoint);

            $term->addBreakpoint($breakpoint);
        }
        catch (Exception\DuplicateBreakpointAmountException $e)
        {
            $this->assertEquals($e->getMessage(), 'Breakpoint with amount 1000 already exists');
        }
        finally
        {
            if (isset($e) === false)
            {
                $this->fail('Exception DuplicateBreakpointAmountException expected. None caught');
            }
        }
    }
}
