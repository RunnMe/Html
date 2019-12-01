<?php

namespace Runn\Html;

/**
 * Trait for elements that have value (like form inputs)
 *
 * Trait HasValueTrait
 * @package Runn\Html
 *
 * @implements \Runn\Html\HasValueInterface
 */
trait HasValueTrait
    /*implements HasValueInterface*/
{

    /** @var mixed|null  */
    protected $__value = null;

    /**
     * @param mixed $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->__value = $value;
        return $this;
    }

    /**
     * @param string $class
     * @return mixed
     */
    public function getValue($class = null)
    {
        if (null === $this->__value || null === $class) {
            return $this->__value;
        }
        return new $class($this->__value);
    }

}
