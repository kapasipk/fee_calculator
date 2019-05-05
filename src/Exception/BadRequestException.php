<?php

declare(strict_types=1);

namespace Lendable\Interview\Interpolation\Exception;

class BadRequestException extends \DomainException
{
    public function __construct(string $message = '')
    {
        parent::__construct('Bad Request - ' . $message, 400);
    }
}
