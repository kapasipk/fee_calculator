<?php

namespace Lendable\Interview\Interpolation\Service\Fee;

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
        $termInstance = new Term($application->getTerm());

        $amount = $application->getAmount();

        $result = $this->interpolationStrategy->calculate($termInstance, $amount);

        return $result;
    }

    public function setInterpolationStrategy(string $interpolationType)
    {
        $className = __NAMESPACE__;
        $className = substr($className, 0, strrpos($className, "\\"));
        $className = substr($className, 0, strrpos($className, "\\"));
        $className = $className . '\\InterpolationStrategy\\' . $interpolationType;

        $interpolationStrategy = new $className;

        $this->interpolationStrategy = $interpolationStrategy;
    }
}
