<?php

namespace Runn\Html\Form\Errors;

use Runn\Core\Exceptions;
use Runn\Validation\ValidationError;

/**
 * HTML form element value validation error collection
 *
 * Class ElementValidationErrors
 * @package Runn\Html\Form\Errors
 *
 * @codeCoverageIgnore
 */
class ElementValidationErrors extends Exceptions
{

    public static function getType()
    {
        return ValidationError::class;
    }

}
