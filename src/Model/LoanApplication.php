<?php

declare(strict_types=1);

namespace Lendable\Interview\Interpolation\Model;

/**
 * Class LoanApplication
 *
 * A cut down version of a loan application containing
 * only the required properties for this test.
 *
 * @package Lendable\Interview\Interpolation\Model
 */
class LoanApplication
{
    /**
     * @var int
     */
    private $term;

    /**
     * @var float
     */
    private $amount;

    /**
     * @param int $term
     * @param float $amount
     */
    public function __construct(int $term, float $amount)
    {
        $this->term = $term;
        $this->amount = $amount;
    }

    /**
     * Gets the term for this loan application expressed
     * in number of months.
     *
     * @return int
     */
    public function getTerm(): int
    {
        return $this->term;
    }

    /**
     * Gets the amount requested for this loan application.
     *
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }
}
