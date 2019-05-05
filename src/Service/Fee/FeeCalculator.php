<?php

namespace Lendable\Interview\Interpolation\Service\Fee;

use Lendable\Interview\Interpolation\Exception;
use Lendable\Interview\Interpolation\InterpolationStrategy\InterpolationStrategyInterface;
use Lendable\Interview\Interpolation\Model\Term;
use Lendable\Interview\Interpolation\Model\LoanApplication;

class FeeCalculator implements FeeCalculatorInterface
{
    private $interpolationStrategy;

    public function __construct($interpolationType = 'Linear')
    {
        $this->setInterpolationStrategy($interpolationType);
    }

    public function calculate(LoanApplication $application): float
    {
        $term   = $application->getTerm();
        $amount = $application->getAmount();

        $termInstance = new Term($term);

        $fee = $this->interpolationStrategy->calculate($termInstance, $amount);

        return $fee;
    }

    public function setInterpolationStrategy(string $interpolationType)
    {
        $interpolationStrategy = $this->getInterpolationStrategyInstance($interpolationType);

        $this->interpolationStrategy = $interpolationStrategy;
    }

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
