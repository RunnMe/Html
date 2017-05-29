<?php

namespace Runn\Html;

use Runn\Html\Form\Form;

/**
 * Common interface for all elements that belong to some form
 *
 * Interface BelongsToFormInterface
 * @package Runn\Html
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
     */
    public function setForm(Form $form);

    /**
     * @return \Runn\Html\Form\Form|null
     */
    public function getForm()/*: ?Form*/;

}