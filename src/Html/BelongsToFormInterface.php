<?php

namespace Runn\Html;

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
     * @param \Runn\Html\Form $form
     * @return $this
     */
    public function setForm(Form $form);

    /**
     * @return \Runn\Html\Form|null
     */
    public function getForm()/*: ?Form*/;

}