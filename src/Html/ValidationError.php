<?php

namespace Runn\Html;

/**
 * Abstract object value validation error class
 *
 * Class ValidationError
 * @package Runn\Html
 */
class ValidationError extends \Runn\Validation\ValidationError
{

    /**
     * @var \Runn\Html\HasValueInterface
     */
    protected $element;

    /**
     * @param \Runn\Html\HasValueInterface $element
     * @param mixed $value
     * @param string $message
     * @param int $code
     * @param \Throwable|null $previous
     */
    public function __construct(HasValueInterface $element, $value = null, $message = "", $code = 0, \Throwable $previous = null)
    {
        $this->element = $element;
        $value = $value ?? $element->getValue();
        parent::__construct($value, $message, $code, $previous);
    }

    /**
     * @return \Runn\Html\HasValueInterface
     */
    public function getElement(): HasValueInterface
    {
        return $this->element;
    }

}
