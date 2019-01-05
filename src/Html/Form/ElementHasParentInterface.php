<?php

namespace Runn\Html\Form;

/**
 * Common interface for form elements that have parent one
 *
 * Interface ElementHasParentInterface
 * @package Runn\Html\Form
 */
interface ElementHasParentInterface
{

    /**
     * @param \Runn\Html\Form\FormElementInterface|null $parent
     * @return $this
     */
    public function setParent(?FormElementInterface $parent);

    /**
     * @return \Runn\Html\Form\FormElementInterface|null
     */
    public function getParent(): ?FormElementInterface;

    /**
     * @return bool
     */
    public function hasParent(): bool;

    /**
     * @return \Runn\Html\Form\ElementsCollection|\Runn\Html\Form\FormElementInterface[]
     */
    public function getParents(): ElementsCollection;

}
