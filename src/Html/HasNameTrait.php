<?php

namespace Runn\Html;

/**
 * Trait for elements that have name (like form inputs)
 *
 * Trait HasNameTrait
 * @package Runn\Html
 *
 * @implements \Runn\Html\HasNameInterface
 */
trait HasNameTrait
    /*implements HasNameInterface*/
{

    /** @var string|null  */
    protected $name = null;

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getName()/*: ?string*/
    {
        return $this->name;
    }

}