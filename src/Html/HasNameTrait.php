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
     * @param string|null $name
     * @return $this
     *
     * @7.1
     */
    public function setName(/*?*/string $name = null)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     *
     * @7.1
     */
    public function getName()/*: ?string*/
    {
        return $this->name;
    }

}