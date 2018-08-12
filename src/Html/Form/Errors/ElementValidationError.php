<?php

namespace Runn\Html\Form\Errors;

use Runn\Html\Form\FormElementInterface;
use Runn\Validation\ValidationError;

/**
 * HTML form element value validation error
 *
 * Class ElementValidationError
 * @package Runn\Html\Form\Errors
 */
class ElementValidationError extends ValidationError
{

    /**
     * @var FormElementInterface
     */
    protected $element;

    /**
     * @param FormElementInterface $element
     * @param mixed $value
     * @param string $message
     * @param int $code
     * @param \Throwable|null $previous
     */
    public function __construct(FormElementInterface $element, $value, $message = "", $code = 0, \Throwable $previous = null)
    {
        $this->element = $element;
        parent::__construct($value, $message, $code, $previous);
    }

    /**
     * @return FormElementInterface
     */
    public function getElement(): FormElementInterface
    {
        return $this->element;
    }

}
