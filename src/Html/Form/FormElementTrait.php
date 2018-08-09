<?php

namespace Runn\Html\Form;

use Runn\Html\Rendering\RenderableTrait;

/**
 * Trait that implements FormElementInterface
 *
 * Trait FormElementTrait
 * @package Runn\Html\Form
 */
trait FormElementTrait
    /*implements FormElementInterface*/
{

    use ElementHasParentTrait, BelongsToFormTrait, RenderableTrait;

}
