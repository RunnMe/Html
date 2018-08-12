<?php

namespace Runn\Html\Form;

/**
 * Common interface for all elements that belong to some form
 *
 * Interface BelongsToFormInterface
 * @package Runn\Html\Form
 */
interface BelongsToFormInterface
{

    /**
     * @return bool
     */
    public function belongsToForm(): bool;

    /**
     * @param \Runn\Html\Form\Form $form
     * @return $this
     *
     * @7.1
     */
    public function setForm(/*?*/Form $form = null);

    /**
     * @return \Runn\Html\Form\Form|null
     *
     * @7.1
     */
    public function getForm()/*: ?Form*/;

}
