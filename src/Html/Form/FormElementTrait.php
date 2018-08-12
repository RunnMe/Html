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
     *
     * @7.1
     */
    public function setParent(/*?*/FormElementInterface $parent)
    {
        if ($parent instanceof Form) {
            $this->setForm($parent);
        } elseif ($parent->belongsToForm()) {
            $this->setForm($parent->getForm());
        }
        return $this->traitSetParent($parent);
    }

    /**
     * @throws \Runn\Html\Form\Errors\ElementValidationError
     * @throws \Runn\Html\Form\Errors\ElementValidationErrors
     * @return bool
     *
     * @todo: add errors generator?
     */
    protected function validate(): bool
    {
        return true;
    }

    /**
     * Is the value of this element valid?
     *
     * @return bool
     */
    public function isValid(): bool
    {
        return $this->getErrors()->empty();
    }

    /**
     * Return collection of validation errors for this element
     *
     * @return \Runn\Html\Form\Errors\ElementValidationErrors
     */
    public function getErrors(): ElementValidationErrors
    {
        $errors = new ElementValidationErrors;
        try {
            $res = $this->validate();
        } catch (ElementValidationError $e) {
            $errors[] = $e;
        } catch (ElementValidationErrors $e) {
            $errors->add($e);
        } catch (\Throwable $e) {
            $error = new ElementValidationError($this, $this instanceof HasValueInterface ? $this->getValue() : null, $e->getMessage(), $e->getCode(), $e);
            $errors[] = $error;
        }
        if (!$res) {
            $error = new ElementValidationError($this, $this instanceof HasValueInterface ? $this->getValue() : null);
            $errors[] = $error;
        }
        return $errors;
    }

}
