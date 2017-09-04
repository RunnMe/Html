<?php

namespace Runn\Html\Form;

/**
 * Common interface for elements that have parent
 *
 * Interface ElementHasParentInterface
 * @package Runn\Html\Form
 */
interface ElementHasParentInterface
{

    /**
     * @param \Runn\Html\Form\ElementInterface $parent
     * @return $this
     *
     * @7.1
     */
    public function setParent(/*?*/ElementInterface $parent);

    /**
     * @return \Runn\Html\Form\ElementInterface|null
     *
     * @7.1
     */
    public function getParent()/*: ?ElementInterface*/;

    /**
     * @return bool
     */
    public function hasParent(): bool;

    /**
     * @return \Runn\Html\Form\ElementsCollection|\Runn\Html\Form\ElementInterface[]
     */
    public function getParents(): ElementsCollection;

}