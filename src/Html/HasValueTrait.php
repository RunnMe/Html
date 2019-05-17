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
    protected $value = null;

    /**
     * @param mixed $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @param string $class
     * @return mixed
     */
    public function getValue($class = null)
    {
        if (null === $this->value || null === $class) {
            return $this->value;
        }
        return new $class($this->value);
    }

}
