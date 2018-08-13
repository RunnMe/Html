<?php

namespace Runn\Html;

use Runn\Core\TypedCollection;

/**
 * Validation errors collection
 *
 * Class ValidationErrors
 * @package Runn\Html\
 */
class ValidationErrors extends TypedCollection
{

    /**
     * @codeCoverageIgnore
     * @return string
     */
    public static function getType()
    {
        return ValidationError::class;
    }

}
