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
 * @package Runn\Html\Form
 */
interface ElementInterface
    extends
    HasNameInterface, HasTitleInterface, HasValueInterface, HasOptionsInterface,
    ElementHasParentInterface, BelongsToFormInterface,
    RenderableInterface
{

    /**
     * Full element's name includes all it's parents names
     * @return string|null
     */
    public function getFullName(): /*?*/string;

}