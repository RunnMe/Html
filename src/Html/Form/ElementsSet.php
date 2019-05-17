<?php

namespace Runn\Html\Form;

use Runn\Html\HasNameInterface;
use Runn\Html\HasNameTrait;
use Runn\Html\HasValueInterface;
use Runn\Html\HasValueValidationInterface;
use Runn\Html\HasValueValidationTrait;
use Runn\Html\ValidationErrors;

/**
 * Set of elements with same class
 * Strict typed collection
 *
 * Class ElementsSet
 * @package Runn\Html\Form
 */
abstract class ElementsSet
    extends ElementsCollection
    implements FormElementInterface, HasNameInterface, HasValueInterface, HasValueValidationInterface
{

    use FormElementTrait;

    use HasNameTrait;

    use HasValueValidationTrait;

    /**
     * @param mixed $value
     * @throws \Runn\Html\Form\Exception
     */
    protected function checkValueType($value)
    {
        $class = static::getType();
        if (!(is_subclass_of($class, FormElementInterface::class))) {
            throw new Exception('Invalid ElementsSet base class "' . $class.'"');
        }
        // turn on strict type check!
        if (!$this->isValueTypeValid($value, true)) {
            throw new Exception('Elements set type mismatch');
        }
    }

    /**
     * @param $key
     * @param $val
     * @throws \Runn\Html\Form\Exception
     */
    public function innerSet($key, $val)
    {
        if (!(null === $key || is_numeric($key))) {
            throw new Exception('Invalid ElementsSet (' . static::class . ') key: "' . $key . '"');
        }
        parent::innerSet($key, $val);
        $val->setParent($this);
    }

    /**
     * @param string $class
     * @return mixed
     */
    public function getValue($class = null)
    {
        $values = [];
        foreach ($this as $key => $element) {
            if ($element instanceof HasValueInterface) {
                $values[$key] = $element->getValue();
            }
        }
        if (null === $class) {
            return $values;
        }
        return new $class($values);
    }

    /**
     * @param iterable $value
     * @return $this
     */
    public function setValue($value)
    {
        if ( is_array($value) || $value instanceof \Traversable ) {
            foreach ($value as $key => $val) {
                if (isset($this[$key]) && ($this[$key] instanceof HasValueInterface)) {
                    $this[$key]->setValue($val);
                }
            }
        }
        return $this;
    }

    /**
     * Makes value validation
     *
     * Returns true if there are no validation errors, false otherwise
     * @return bool
     */
    public function validate(): bool
    {
        foreach ($this as $element) {
            if ($element instanceof HasValueValidationInterface) {
                $element->validate();
            }
        }
        return $this->errors()->empty();
    }

    /**
     * Returns validation errors collection
     *
     * @todo: cache errors
     *
     * @return \Runn\Html\ValidationErrors
     */
    public function errors(): ValidationErrors
    {
        $errors = new ValidationErrors();
        foreach ($this as $key => $element) {
            if ($element instanceof HasValueValidationInterface) {
                $e = $element->errors();
                if (!$e->empty()) {
                    $errors[$key] = $e;
                }
            }
        }
        return $errors;
    }

}
