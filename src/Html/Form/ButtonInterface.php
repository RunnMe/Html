<?php

namespace Runn\Html\Form;

use Runn\Html\HasTitleInterface;
use Runn\Html\RenderableInterface;

/**
 * Common interface for all form buttons
 *
 * Interface ButtonInterface
 * @package Runn\Html\Form
 */
interface ButtonInterface
    extends
    HasTitleInterface,
    ElementHasParentInterface, BelongsToFormInterface,
    RenderableInterface
{
}