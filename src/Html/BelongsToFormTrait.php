<?php

namespace Runn\Html;

/**
 * Trait for elements that belong to some form
 *
 * Trait BelongsToFormTrait
 * @package Runn\Html
 *
 * @implements \Runn\Html\BelongsToFormInterface
 */
trait BelongsToFormTrait
    /*implements BelongsToFormInterface*/
{

    /** @var \Runn\Html\Form|null  */
    protected $form = null;

    /**
     * @return bool
     */
    public function belongsToForm(): bool
    {
        return null !== $this->form;
    }

    /**
     * @param \Runn\Html\Form $form
     * @return $this
     */
    public function setForm(Form $form)
    {
        $this->form = $form;
        return $this;
    }

    /**
     * @return \Runn\Html\Form|null
     */
    public function getForm()/*: ?Form*/
    {
        return $this->form;
    }

}