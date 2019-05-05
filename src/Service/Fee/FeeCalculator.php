<?php

declare(strict_types=1);

namespace Lendable\Interview\Interpolation\Service\Fee;

use Lendable\Interview\Interpolation\Exception;
use Lendable\Interview\Interpolation\Model\Term;
use Lendable\Interview\Interpolation\Model\LoanApplication;
use Lendable\Interview\Interpolation\InterpolationStrategy\InterpolationStrategyInterface;

/**
 * Class FeeCalculator
 *
 * @package Lendable\Interview\Interpolation\Service\Fee
 */
class FeeCalculator implements FeeCalculatorInterface
{
    /**
     * @var
     */
    private $interpolationStrategy;

    /**
     * FeeCalculator constructor.
     *
     * @param string $interpolationType
     *
     * @throws Exception\InvalidInterpolationStrategyException
     */
    public function __construct($interpolationType = 'Linear')
    {
        $this->setInterpolationStrategy($interpolationType);
    }

    /**
     * Calculates the fee for a loan application.
     *
     * @param LoanApplication $application The loan application to calculate for.
     *
     * @return float
     */
    public function calculate(LoanApplication $application): float
    {
        $term   = $application->getTerm();
        $amount = $application->getAmount();

        $termInstance = new Term($term);

        $fee = $this->interpolationStrategy->calculate($termInstance, $amount);

        return $fee;
    }

    /**
     * @param string $interpolationType
     *
     * @throws Exception\InvalidInterpolationStrategyException
     */
    public function setInterpolationStrategy(string $interpolationType)
    {
        $interpolationStrategy = $this->getInterpolationStrategyInstance($interpolationType);

        $this->interpolationStrategy = $interpolationStrategy;
    }

    /**
     * @param string $interpolationType
     *
     * @return InterpolationStrategyInterface
     * @throws Exception\InvalidInterpolationStrategyException
     */
    private function getInterpolationStrategyInstance(string $interpolationType): InterpolationStrategyInterface
    {
        $className = __NAMESPACE__;
        $className = substr($className, 0, strrpos($className, "\\"));
        $className = substr($className, 0, strrpos($className, "\\"));
        $className = $className . '\\InterpolationStrategy\\' . $interpolationType;

        if (class_exists($className) === false)
        {
            throw new Exception\InvalidInterpolationStrategyException($interpolationType);
        }

        $interpolationStrategy = new $className;

        return $interpolationStrategy;
    }
}
