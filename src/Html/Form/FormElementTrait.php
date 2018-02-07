<?php

namespace Runn\Html\Form;

use Runn\Html\RenderableTrait;

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