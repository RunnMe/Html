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
     *
     * @7.1
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
     *
     * @7.1
     */
    public function getAttribute(string $key): ?string
    {
        return $this->attributes->$key ?? null;
    }

    /**
     * @param iterable|null $attributes
     * @return $this
     *
     * @7.1
     */
    public function setAttributes(iterable $attributes = null)
    {
        $this->attributes = new Std;
        if (null !== $attributes) {
            foreach ($attributes as $key => $val) {
                $this->setAttribute($key, $val);
            }
        }
        return $this;
    }

    /**
     * @return \Runn\Core\Std
     *
     * @7.1
     */
    public function getAttributes(): ?\Runn\Core\Std
    {
        return $this->attributes;
    }

}