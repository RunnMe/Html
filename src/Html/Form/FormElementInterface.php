<?php

namespace Runn\Html\Form;

use Runn\Html\Rendering\RenderableInterface;

/**
 * Common interface for all form elements: input fields, output areas, datasets, buttons, element groups and sets etc
 *
 * Interface FormElementInterface
 * @package Runn\Html\Form
 */
interface FormElementInterface
    extends BelongsToFormInterface, ElementHasParentInterface, RenderableInterface
{
}
