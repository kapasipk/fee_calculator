<?php

declare(strict_types=1);

namespace Lendable\Interview\Interpolation\Exception;

/**
 * Class InvalidTermException
 *
 * @package Lendable\Interview\Interpolation\Exception
 */
class InvalidTermException extends BadRequestException
{
    /**
     * InvalidTermException constructor.
     *
     * @param int $noOfMonths
     */
    public function __construct(int $noOfMonths)
    {
        parent::__construct('No term for ' . $noOfMonths . ' months has been defined');
    }
}
