<?php

namespace Runn\Html;

use Runn\ValueObjects\Exception;
use Runn\ValueObjects\SimpleValueObject;
use Runn\ValueObjects\ValueObjectInterface;

/**
 * Trait for elements that have value (like form inputs) and can cast it to Value Object
 *
 * Trait HasValueWithValueObjectTrait
 * @package Runn\Html
 *
 * @implements \Runn\Html\HasValueWithValueObjectInterface
 */
trait HasValueWithValueObjectTrait
{

    use HasValueTrait {
        setValue as protected traitSetValue;
    }

    /**
     * @param mixed $value
     * @return $this
     * @throws \Runn\ValueObjects\Exception
     */
    public function setValue($value)
    {
        if ($value instanceof ValueObjectInterface) {
            $class = static::getValueObjectClass();
            if (!($value instanceof $class)) {
                throw new Exception('Invalid value object class: "' . get_class($value) . '"');
            }
            $value = $value->getValue();
        }
        $this->traitSetValue($value);
        return $this;
    }

    /**
     * @codeCoverageIgnore
     * @return string
     */
    public static function getValueObjectClass(): string
    {
        return SimpleValueObject::class;
    }

    /**
     * @return \Runn\ValueObjects\ValueObjectInterface|null
     */
    public function getValueObject()/*: ?ValueObjectInterface*/
    {
        $class = static::getValueObjectClass();
        $value = $this->getValue();
        return null === $value ? null : new $class($this->getValue());
    }

}