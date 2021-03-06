<?php

declare(strict_types=1);

namespace Lendable\Interview\Interpolation\Tests\Unit;

use Lendable\Interview\Interpolation\Exception;
use Lendable\Interview\Interpolation\Model\LoanApplication;
use Lendable\Interview\Interpolation\Service\Fee\FeeCalculator;

/**
 * Class FeeCalculatorTest
 */
class FeeCalculatorTest extends Base
{
    /**
     * Asserts linear interpolation
     */
    public function testLinearInterpolation()
    {
        $calculator = new FeeCalculator();

        $application = new LoanApplication(24, 2750);

        $fee = $calculator->calculate($application);

        $this->assertEquals(115.0, $fee);
    }

    /**
     * Asserts linear interpolation upto 1 decimal point
     */
    public function testLinearInterpolation1DecimalPoint()
    {
        $calculator = new FeeCalculator();

        $application = new LoanApplication(24, 2750.4);

        $fee = $calculator->calculate($application);

        // Fee = 119.6, Amount = 2750.4, Total = 2870
        $this->assertEquals(119.6, $fee);
    }

    /**
     * Asserts linear interpolation upto 2 decimal points
     */
    public function testLinearInterpolation2DecimalPoints()
    {
        $calculator = new FeeCalculator();

        $application = new LoanApplication(24, 2750.56);

        $fee = $calculator->calculate($application);

        // Fee = 119.44, Amount = 2750.56, Total = 2870
        $this->assertEquals(119.44, $fee);
    }

    /**
     * Asserts that invalid term exception is thrown if the term is not defined
     */
    public function testLinearInterpolationInvalidTerm()
    {
        $exceptionData = [
            'class'   => Exception\InvalidTermException::class,
            'message' => 'Bad Request - No term for 36 months has been defined',
        ];

        $this->runUnderExceptionHandler(function ()
        {
            $calculator = new FeeCalculator();

            $application = new LoanApplication(36, 2750);

            $calculator->calculate($application);
        }, $exceptionData);
    }

    /**
     * Asserts that invalid amount exception is thrown if the amount is out of min-max term range
     */
    public function testLinearInterpolationLoanAmountOutOfRange()
    {
        $exceptionData = [
            'class'   => Exception\AmountOutOfRangeException::class,
            'message' => 'Bad Request - The loan amount 22750 is out of the term range defined',
        ];

        $this->runUnderExceptionHandler(function ()
        {
            $calculator = new FeeCalculator();

            $application = new LoanApplication(12, 22750);

            $calculator->calculate($application);
        }, $exceptionData);
    }

    /**
     * Asserts that invalid interpolation strategy exception is thrown if the
     */
    public function testInvalidInterpolationStrategy()
    {
        $exceptionData = [
            'class'   => Exception\InvalidInterpolationStrategyException::class,
            'message' => 'Bad Request - Gaussian Interpolation strategy has not been defined',
        ];

        $this->runUnderExceptionHandler(function ()
        {
            new FeeCalculator('Gaussian');
        }, $exceptionData);
    }
}
