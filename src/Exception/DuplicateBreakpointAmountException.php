<?php

declare(strict_types=1);

namespace Lendable\Interview\Interpolation\Exception;

use RuntimeException;
use Throwable;

class DuplicateBreakpointAmountException extends RuntimeException
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
