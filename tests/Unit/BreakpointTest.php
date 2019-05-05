<?php

use \PHPUnit\Framework\TestCase;
use Lendable\Interview\Interpolation\Exception;
use Lendable\Interview\Interpolation\Model\Breakpoint;
use Lendable\Interview\Interpolation\TermData\Constants;

class BreakpointTest extends TestCase
{
//    public function testMissingBreakpointAttributes()
//    {
//        try
//        {
//            $term = new Term(12);
//
//            $term->addBreakpoint($breakpoint);
//        }
//        catch (Exception\AmountOutOfRangeException $e)
//        {
//            $this->assertEquals($e->getMessage(), 'Bad Request - The loan amount 22750 is out of the term range defined');
//        }
//        finally
//        {
//            if (isset($e) === false)
//            {
//                $this->fail('Exception AmountOutOfRangeException expected. None caught');
//            }
//        }
//    }

    public function testMissingBreakpointAttributes()
    {
        try
        {
            $data = [Constants::AMOUNT => 1000];

            new Breakpoint($data);
        }
        catch (Exception\MissingBreakpointAttributesException $e)
        {
            $this->assertEquals($e->getMessage(),'Required breakpoint attributes are missing.');
        }
        finally
        {
            if (isset($e) === false)
            {
                $this->fail('Exception MissingBreakpointAttributesException expected. None caught');
            }
        }
    }
}
