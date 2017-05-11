<?php

namespace Runn\Html;

use Runn\Core\Std;

/**
 * Trait for elements that have name (like form inputs)
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
     * @param string $val
     * @return $this
     */
    public function setAttribute(string $key, /*?*/string $val = null)
    {
        if (null === $this->attributes ) {
            $this->attributes  = new Std;
        }
        $this->attributes ->$key = $val;
        return $this;
    }

    /**
     * @param string $key
     * @return string|null
     */
    public function getAttribute($key)
    {
        return $this->attributes->$key ?? null;
    }

    /**
     * @param null $attributes
     * @return $this
     */
    public function attributes(/*iterable */$attributes = null)
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
     */
    public function getAttributes()/*: ?\Runn\Core\Std*/
    {
        return $this->attributes;
    }

}