<?php

namespace Runn\Html\Form;

use Runn\Html\Form\Errors\ElementValidationError;
use Runn\Html\Form\Errors\ElementValidationErrors;
use Runn\Html\HasValueInterface;
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

    use ElementHasParentTrait {
        setParent as traitSetParent;
    }

    use BelongsToFormTrait, RenderableTrait;

    /**
     * @param \Runn\Html\Form\FormElementInterface $parent
     * @return $this
     */
    public function setParent(?FormElementInterface $parent)
    {
        if ($parent instanceof Form) {
            $this->setForm($parent);
        } elseif ($parent->belongsToForm()) {
            $this->setForm($parent->getForm());
        }
        return $this->traitSetParent($parent);
    }

}
