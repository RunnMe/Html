<?php

namespace Runn\Html\Form\Errors;

use Runn\Html\Form\ElementInterface;
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
     * @var ElementInterface
     */
    protected $element;

    /**
     * @param ElementInterface $element
     * @param mixed $value
     * @param string $message
     * @param int $code
     * @param \Throwable|null $previous
     */
    public function __construct(ElementInterface $element, $value, $message = "", $code = 0, \Throwable $previous = null)
    {
        $this->element = $element;
        parent::__construct($value, $message, $code, $previous);
    }

    /**
     * @return ElementInterface
     */
    public function getElement(): ElementInterface
    {
        return $this->element;
    }

}
