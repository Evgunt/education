<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class IntValidator extends AbstractValidator
{

    protected string $message = 'Field :field must be int';

    public function rule(): bool
    {
        return is_int($this->value);
    }
}
