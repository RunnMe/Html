<?php

namespace Runn\Html\Form;

/**
 * Trait for elements that belong to some form
 *
 * Trait BelongsToFormTrait
 * @package Runn\Html\Form
 *
 * @implements \Runn\Html\Form\BelongsToFormInterface
 */
trait BelongsToFormTrait
    /*implements BelongsToFormInterface*/
{

    /** @var \Runn\Html\Form\Form|null  */
    protected $form = null;

    /**
     * @return bool
     */
    public function belongsToForm(): bool
    {
        return null !== $this->form;
    }

    /**
     * @param \Runn\Html\Form\Form $form
     * @return $this
     *
     * @7.1
     */
    public function setForm(/*?*/Form $form)
    {
        $this->form = $form;
        return $this;
    }

    /**
     * @return \Runn\Html\Form\Form|null
     *
     * @7.1
     */
    public function getForm()/*: ?Form*/
    {
        return $this->form;
    }

}