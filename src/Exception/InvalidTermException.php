<?php

declare(strict_types=1);

namespace Lendable\Interview\Interpolation\Exception;

class InvalidTermException extends BadRequestException
{
    public function __construct(int $noOfMonths)
    {
        parent::__construct('No term for ' . $noOfMonths . ' months has been defined');
    }
}
