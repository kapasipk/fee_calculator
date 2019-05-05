<?php

use \PHPUnit\Framework\TestCase;
use Lendable\Interview\Interpolation\Exception;
use Lendable\Interview\Interpolation\Model\Breakpoint;
use Lendable\Interview\Interpolation\TermData\Constants;

/**
 * Class BreakpointTest
 */
class BreakpointTest extends TestCase
{
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
