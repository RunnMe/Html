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
    protected $title = null;

    /**
     * @param string|null $title
     * @return $this
     *
     * @7.1
     */
    public function setTitle(/*?*/string $title = null)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string|null
     *
     * @7.1
     */
    public function getTitle()/*: ?string*/
    {
        return $this->title;
    }

}