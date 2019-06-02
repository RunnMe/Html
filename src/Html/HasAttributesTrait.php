<?php

namespace Runn\Html;

use Runn\Core\Std;

/**
 * Trait for all elements that have html attributes (forms, form inputs, another html tags)
 *
 * Trait HasAttributesTrait
 * @package Runn\Html
 *
 * @implements \Runn\Html\HasAttributesInterface
 */
trait HasAttributesTrait
    /*implements HasAttributesInterface*/
{

    /** @var \Runn\Core\Std|null  */
    protected $__attributes = null;

    /**
     * @param string $key
     * @param string|null $val
     * @return $this
     * @throws \Runn\Core\Exceptions
     */
    public function setAttribute(string $key, ?string $val)
    {
        if (null === $this->__attributes ) {
            $this->__attributes  = new Std;
        }
        $this->__attributes->$key = $val;
        return $this;
    }

    /**
     * @param string $key
     * @return string|null
     */
    public function getAttribute(string $key): ?string
    {
        return $this->__attributes->$key ?? null;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function issetAttribute(string $key): bool
    {
        return isset($this->__attributes->$key);
    }

    /**
     * @param string $key
     */
    public function unsetAttribute(string $key): void
    {
        unset($this->__attributes->$key);
    }

    /**
     * @param iterable|null $__attributes
     * @return $this
     * @throws \Runn\Core\Exceptions
     */
    public function setAttributes(iterable $__attributes = null)
    {
        if (null === $__attributes) {
            $this->__attributes = null;
            return $this;
        }
        $this->__attributes = new Std;
        foreach ($__attributes as $key => $val) {
            $this->setAttribute($key, $val);
        }
        return $this;
    }

    /**
     * @return \Runn\Core\Std|null
     */
    public function getAttributes(): ?\Runn\Core\Std
    {
        return $this->__attributes;
    }

}
