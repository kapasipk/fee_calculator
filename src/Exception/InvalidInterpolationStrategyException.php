<?php

declare(strict_types=1);

namespace Lendable\Interview\Interpolation\Exception;

/**
 * Class InvalidInterpolationStrategyException
 *
 * @package Lendable\Interview\Interpolation\Exception
 */
class InvalidInterpolationStrategyException extends BadRequestException
{
    /**
     * InvalidInterpolationStrategyException constructor.
     *
     * @param string $interpolationType
     */
    public function __construct(string $interpolationType)
    {
        parent::__construct($interpolationType . ' Interpolation strategy has not been defined');
    }
}
