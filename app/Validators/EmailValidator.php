<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class EmailValidator extends AbstractValidator
{

    protected string $message = 'Field :field must be email type';

    public function rule(): bool
    {
        return filter_var($this->value, FILTER_VALIDATE_EMAIL);
    }
}
