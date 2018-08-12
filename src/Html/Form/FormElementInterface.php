<?php

namespace Runn\Html\Form;

use Runn\Html\Form\Errors\ElementValidationErrors;
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


    /**
     * Is the value of this element valid?
     *
     * @return bool
     */
    public function isValid(): bool;

    /**
     * Return collection of validation errors for this element
     *
     * @return ElementValidationErrors
     */
    public function getErrors(): ElementValidationErrors;

}
