<?php

namespace Runn\Html\Form;

use Runn\Core\HasSchemaInterface;
use Runn\Core\HasSchemaTrait;
use Runn\Core\ObjectAsArrayInterface;
use Runn\Core\StdGetSetInterface;
use Runn\Core\StdGetSetTrait;
use Runn\Html\HasAttributesInterface;
use Runn\Html\HasNameInterface;
use Runn\Html\HasOptionsInterface;
use Runn\Html\HasTitleInterface;
use Runn\Html\HasValueInterface;

/**
 * Abstract elements group
 *
 * Class ElementsGroup
 * @package Runn\Html\Form
 */
abstract class ElementsGroup
    implements ObjectAsArrayInterface, StdGetSetInterface, HasSchemaInterface, ElementInterface
{

    use StdGetSetTrait {
        innerSet as traitInnerSet;
    }

    /**
     * @return array
     */
    protected function notgetters(): array
    {
        return ['schema', 'name', 'title', 'value', 'option', 'options', 'parent', 'parents', 'form', 'fullName'];
    }

    /**
     * @return array
     */
    protected function notsetters(): array
    {
        return ['name', 'title', 'value', 'option', 'options', 'parent', 'form'];
    }


    protected static $schema = [];

    use HasSchemaTrait {
        prepareValueBySchemaDef as traitPrepareValueBySchemaDef;
    }

    use ElementTrait;

    /**
     * Constructor.
     * @param iterable|null $data
     */
    public function __construct(/* iterable */ $data = null)
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
        if (!($val instanceof ElementInterface)) {
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
    protected function prepareValueBySchemaDef($key, /*iterable */$def)
    {
        if (empty($def['class'])) {
            throw new Exception('Invalid group schema: class for element "' . $key  .'" is missing');
        }

        $class = $def['class'];
        if (!is_subclass_of($class, ElementInterface::class)) {
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
        foreach ($this as $key => $el) {
            if ($el instanceof HasValueInterface) {
                $values[$key] = $el->getValue();
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
        // @todo: is_iterable()
        if ( is_array($value) || $value instanceof \Traversable ) {
                foreach ($value as $key => $val) {
                    if (isset($this->$key) && ($this->$key instanceof HasValueInterface)) {
                        $this->$key->setValue($val);
                    }
                }
        }
        return $this;
    }

}