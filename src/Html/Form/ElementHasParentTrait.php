<?php

namespace Runn\Html\Form;

/**
 * Trait that implements ElementHasParentInterface for elements that have parent
 *
 * Trait ElementHasParentTrait
 * @package Runn\Html\Form
 *
 * @implements \Runn\Html\HasParentInterface
 */
trait ElementHasParentTrait
{

    /** @var \Runn\Html\Form\ElementInterface|null  */
    protected $parent;

    /**
     * @param \Runn\Html\Form\ElementInterface $parent
     * @return $this
     *
     * @7.1
     */
    public function setParent(/*?*/ElementInterface $parent)
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * @return \Runn\Html\Form\ElementInterface|null
     *
     * @7.1
     */
    public function getParent()/*: ?ElementInterface*/
    {
        return $this->parent;
    }

    /**
     * @return bool
     */
    public function hasParent(): bool
    {
        return null !== $this->parent;
    }

    /**
     * @return \Runn\Html\Form\ElementsCollection|\Runn\Html\Form\ElementInterface[]
     */
    public function getParents(): ElementsCollection
    {
        $parents = new ElementsCollection();
        $element = $this;
        while ( ($element instanceof ElementHasParentInterface) && null !== ($parent = $element->getParent()) ) {
            $parents->prepend($parent);
            $element = $parent;
        }
        return $parents;
    }

}