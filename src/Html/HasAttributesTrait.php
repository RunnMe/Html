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
    protected $attributes = null;

    /**
     * @param string $key
     * @param string|null $val
     * @return $this
     */
    public function setAttribute(string $key, ?string $val)
    {
        if (null === $this->attributes ) {
            $this->attributes  = new Std;
        }
        $this->attributes->$key = $val;
        return $this;
    }

    /**
     * @param string $key
     * @return string|null
     */
    public function getAttribute(string $key): ?string
    {
        return $this->attributes->$key ?? null;
    }

    /**
     * @param iterable|null $attributes
     * @return $this
     */
    public function setAttributes(iterable $attributes = null)
    {
        if (null === $attributes) {
            $this->attributes = null;
            return $this;
        }
        $this->attributes = new Std;
        foreach ($attributes as $key => $val) {
            $this->setAttribute($key, $val);
        }
        return $this;
    }

    /**
     * @return \Runn\Core\Std|null
     */
    public function getAttributes(): ?\Runn\Core\Std
    {
        return $this->attributes;
    }

}
