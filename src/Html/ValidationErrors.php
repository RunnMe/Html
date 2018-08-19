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

    /**
     * Let's allow nested collections!
     *
     * @param mixed $value
     * @param bool $strict
     * @return bool
     */
    protected function isValueTypeValid($value, $strict = false): bool
    {
        return parent::isValueTypeValid($value, $strict) ?: ($value instanceof self);
    }

}
