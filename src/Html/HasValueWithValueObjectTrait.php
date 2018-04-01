<?php

namespace Runn\Html;

use Runn\ValueObjects\Exception;
use Runn\ValueObjects\SingleValueObject;
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
    /*implements HasValueWithValueObjectInterface*/
{

    use HasValueTrait {
        setValue as protected trait_setValue;
    }

    /**
     * @codeCoverageIgnore
     * @return string
     */
    public static function getValueObjectClass(): string
    {
        return SingleValueObject::class;
    }

    /**
     * @param mixed $value
     * @return $this
     * @throws \Runn\ValueObjects\Exception
     */
    public function setValue($value)
    {
        $class = static::getValueObjectClass();
        if ($value instanceof ValueObjectInterface) {
            if (!($value instanceof $class)) {
                throw new Exception('Invalid value object class: "' . get_class($value) . '"');
            }
            $value = $value->getValue();
        } else {
            $valueObject = new $class($value);
            $value = $valueObject->getValue();
        }
        $this->trait_setValue($value);
        return $this;
    }

    /**
     * @return \Runn\ValueObjects\ValueObjectInterface|null
     *
     * @7.1
     */
    public function getValueObject()/*: ?ValueObjectInterface*/
    {
        $class = static::getValueObjectClass();
        $value = $this->getValue();
        return null === $value ? null : new $class($this->getValue());
    }

}
