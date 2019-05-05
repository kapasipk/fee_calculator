<?php

declare(strict_types=1);

namespace Lendable\Interview\Interpolation\Exception;

class AmountOutOfRangeException extends BadRequestException
{
    public function __construct(int $loanAmount)
    {
        parent::__construct('The loan amount ' . $loanAmount . ' is out of the term range defined');
    }
}
