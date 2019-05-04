<?php

declare(strict_types=1);

namespace Lendable\Interview\Interpolation\TermData;

abstract class Base
{
    protected $data = [];

    public function getData(): array
    {
        return $this->data;
    }
}
