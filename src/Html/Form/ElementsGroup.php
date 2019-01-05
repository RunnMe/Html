<?php

namespace Runn\Html\Form;

use Runn\Core\HasSchemaInterface;
use Runn\Core\HasSchemaTrait;
use Runn\Core\ObjectAsArrayInterface;
use Runn\Core\StdGetSetInterface;
use Runn\Core\StdGetSetTrait;
use Runn\Html\HasAttributesInterface;
use Runn\Html\HasNameInterface;
use Runn\Html\HasNameTrait;
use Runn\Html\HasOptionsInterface;
use Runn\Html\HasTitleInterface;
use Runn\Html\HasValueInterface;
use Runn\Html\HasValueValidationInterface;
use Runn\Html\HasValueValidationTrait;
use Runn\Html\ValidationErrors;
use Runn\Validation\Validator;

/**
 * Abstract elements group
 *
 * Class ElementsGroup
 * @package Runn\Html\Form
 */
abstract class ElementsGroup
    implements
    ObjectAsArrayInterface, StdGetSetInterface, HasSchemaInterface,
    FormElementInterface, HasNameInterface, HasValueInterface, HasValueValidationInterface
{

    use StdGetSetTrait {
        innerSet as traitInnerSet;
    }

    protected static $schema = [];

    use HasSchemaTrait {
        prepareValueBySchemaDef as traitPrepareValueBySchemaDef;
    }

    use FormElementTrait;

    use HasNameTrait;

    use HasValueValidationTrait;

    /**
     * @return array
     */
    protected function notgetters(): array
    {
        return [
            'schema',
            'parent', 'parents',
            'form',
            'renderer',
            'template', 'defaultTemplate',
            'name', 'fullName',
            'value', 'validator',
        ];
    }

    /**
     * @return array
     */
    protected function notsetters(): array
    {
        return [
            'parent',
            'form',
            'renderer',
            'template',
            'name',
            'value', 'validator'
        ];
    }

    /**
     * Constructor.
     * @param iterable|null $data
     */
    public function __construct(?iterable $data = null)
    {
        if (null !== $data) {
            $this->fromArray($data);
        } else {
            $this->fromSchema($this->getSchema());
        }
    }

    /**
     * Does value need cast to this (or another) class?
     * @param mixed $key
     * @param mixed $value
     * @return bool
     */
    protected function needCasting($key, $value): bool
    {
        return false;
    }

    protected function innerSet($key, $val)
    {
        if ('' === $key || is_numeric($key)) {
            throw new Exception('Invalid ElementsGroup (' . static::class . ') key: ' . $key);
        }
        if (!($val instanceof FormElementInterface)) {
            throw new Exception('Invalid ElementsGroup (' . static::class . ') value by key: ' . $key);
        }
        $this->traitInnerSet($key, $val);
        $val->setParent($this);
    }

    /**
     * @param string $key
     * @param iterable $def
     * @return mixed
     * @throws \Runn\Html\Form\Exception
     */
    protected function prepareValueBySchemaDef($key, iterable $def)
    {
        if (empty($def['class'])) {
            throw new Exception('Invalid group schema: class for element "' . $key  .'" is missing');
        }

        $class = $def['class'];
        if (!is_subclass_of($class, FormElementInterface::class)) {
            throw new Exception('Invalid group schema: class for element "' . $key  .'" is not a form element class');
        }

        $value = $this->traitPrepareValueBySchemaDef($key, $def);

        if ($value instanceof HasNameInterface) {
            $value->setName($def['name'] ?? $key);
        }

        if (($value instanceof HasOptionsInterface) && isset($def['options'])) {
            $value->setOptions($def['options']);
        }

        if (($value instanceof HasAttributesInterface) && isset($def['attributes'])) {
            $value->setAttributes($def['attributes']);
            $value->setAttribute('name', $def['name'] ?? $key);
        }

        if (($value instanceof HasTitleInterface) && isset($def['title'])) {
            $value->setTitle($def['title']);
        }

        if (($value instanceof HasValueValidationInterface) && isset($def['validator'])) {
            if (!is_subclass_of($def['validator'], Validator::class)) {
                throw new Exception('Invalid group schema: validator class for element "' . $key  .'" is not a validator class');
            }
            $value->setValidator(new $def['validator']);
        }

        if (($value instanceof HasValueInterface) && isset($def['value'])) {
            $value->setValue($def['value']);
        }

        return $value;
    }

    /**
     * @return array
     */
    public function getValue()
    {
        $values = [];
        foreach ($this as $key => $element) {
            if ($element instanceof HasValueInterface) {
                $values[$key] = $element->getValue();
            }
        }
        return $values;
    }

    /**
     * @param iterable $value
     * @return $this
     */
    public function setValue($value)
    {
        if ( is_array($value) || $value instanceof \Traversable ) {
            foreach ($value as $key => $val) {
                if (isset($this->$key) && ($this->$key instanceof HasValueInterface)) {
                    $this->$key->setValue($val);
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
