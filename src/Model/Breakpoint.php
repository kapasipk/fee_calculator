<?php

declare(strict_types=1);

namespace Lendable\Interview\Interpolation\Model;

use Lendable\Interview\Interpolation\Exception;
use Lendable\Interview\Interpolation\TermData\Constants;

class Breakpoint
{
    private $amount = 0.0;

    private $fee = 0.0;

    public function __construct(array $breakpointData)
    {
        $this->validateCreate($breakpointData);

        $this->setAmount($breakpointData[Constants::AMOUNT]);

        $this->setFee($breakpointData[Constants::FEE]);
    }

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
