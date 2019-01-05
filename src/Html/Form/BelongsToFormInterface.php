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
     * @param \Runn\Html\Form\Form|null $form
     * @return $this
     */
    public function setForm(?Form $form);

    /**
     * @return \Runn\Html\Form\Form|null
     */
    public function getForm(): ?Form;

}
