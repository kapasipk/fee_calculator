<?php

declare(strict_types=1);

namespace Lendable\Interview\Interpolation\Model;

use Lendable\Interview\Interpolation\Exception;
use Lendable\Interview\Interpolation\TermData\Constants;

/**
 * Class Breakpoint
 *
 * @package Lendable\Interview\Interpolation\Model
 */
class Breakpoint
{
    /**
     * @var float
     */
    private $amount = 0.0;

    /**
     * @var float
     */
    private $fee = 0.0;

    /**
     * Breakpoint constructor.
     *
     * @param array $breakpointData
     *
     * @throws Exception\MissingBreakpointAttributesException
     */
    public function __construct(array $breakpointData)
    {
        $this->validateCreate($breakpointData);

        $this->setAmount($breakpointData[Constants::AMOUNT]);

        $this->setFee($breakpointData[Constants::FEE]);
    }

    /**
     * Breakpoint-create validations go here.
     *
     * A separate validation service can be built for general validations. Refer - Laravel validators for more info.
     *
     * @param array $breakpointData
     *
     * @throws Exception\MissingBreakpointAttributesException
     */
    private function validateCreate(array $breakpointData)
    {
        $requiredAttributes = [
            Constants::FEE,
            Constants::AMOUNT,
        ];

        if (count(array_intersect(array_keys($breakpointData), $requiredAttributes)) !== count($requiredAttributes))
        {
            throw new Exception\MissingBreakpointAttributesException($breakpointData);
        }
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     */
    public function setAmount(float $amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return float
     */
    public function getFee(): float
    {
        return $this->fee;
    }

    /**
     * @param float $fee
     */
    public function setFee(float $fee)
    {
        $this->fee = $fee;
    }
}
