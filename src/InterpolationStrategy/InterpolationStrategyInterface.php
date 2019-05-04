<?php

declare(strict_types=1);

namespace Lendable\Interview\Interpolation\InterpolationStrategy;

use Lendable\Interview\Interpolation\Model\Term;

interface InterpolationStrategyInterface
{
    public function calculate(Term $term, float $loanAmount): float;
}
