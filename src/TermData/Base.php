<?php

declare(strict_types=1);

namespace Lendable\Interview\Interpolation\TermData;

/**
 * Class Base
 *
 * @package Lendable\Interview\Interpolation\TermData
 */
abstract class Base
{
    /**
     * @var array
     */
    protected $data = [];

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
}
