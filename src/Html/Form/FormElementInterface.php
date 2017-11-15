<?php

namespace Runn\Html\Form;

use Runn\Html\HasAttributesInterface;
use Runn\Html\RenderableInterface;

/**
 * Common interface for all form elements: inputs, outputs, datasets, buttons etc
 *
 * Interface FormElementInterface
 * @package Runn\Html\Form
 */
interface FormElementInterface
    extends HasAttributesInterface, ElementHasParentInterface, BelongsToFormInterface, RenderableInterface
{
}