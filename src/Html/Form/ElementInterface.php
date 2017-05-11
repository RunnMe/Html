<?php

namespace Runn\Html\Form;

use Runn\Html\BelongsToFormInterface;
use Runn\Html\HasNameInterface;
use Runn\Html\HasOptionsInterface;
use Runn\Html\HasTitleInterface;
use Runn\Html\HasValueInterface;
use Runn\Html\RenderableInterface;

/**
 * Common interface for all form elements: inputs, groups, collections
 *
 * Interface ElementInterface
 * @package Runn\Html
 */
interface ElementInterface
    extends HasNameInterface, HasTitleInterface, HasValueInterface, HasOptionsInterface, BelongsToFormInterface, RenderableInterface
{

    /**
     * @return string|null
     */
    public function getNameHash()/*: ?string*/;

    /**
     * @param \Runn\Html\Form\ElementInterface $parent
     * @return $this
     */
    public function setParent(ElementInterface $parent);

    /**
     * @return \Runn\Html\Form\ElementInterface|null
     */
    public function getParent()/*: ?ElementInterface*/;

    /**
     * @return \Runn\Html\Form\ElementsCollection|\Runn\Html\Form\ElementInterface[]
     */
    public function getParents(): ElementsCollection;

}