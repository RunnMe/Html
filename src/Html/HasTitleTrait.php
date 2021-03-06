<?php

namespace Runn\Html;

/**
 * Trait for elements that have visible title (like inputs with labels)
 *
 * Trait HasTitleTrait
 * @package Runn\Html
 *
 * @implements \Runn\Html\HasTitleInterface
 */
trait HasTitleTrait
    /*implements HasTitleInterface*/
{

    /** @var string|null  */
    protected $__title = null;

    /**
     * @param string|null $title
     * @return $this
     */
    public function setTitle(?string $title)
    {
        $this->__title = $title;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->__title;
    }

}
