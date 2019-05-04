<?php

declare(strict_types=1);

namespace Lendable\Interview\Interpolation\Model;

class Breakpoint
{
    private $amount = 0;

    private $fee = 0;

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     */
    public function setAmount(int $amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return int
     */
    public function getFee(): int
    {
        return $this->fee;
    }

    /**
     * @param int $fee
     */
    public function setFee(int $fee)
    {
        $this->fee = $fee;
    }
}
