<?php

namespace Runn\Html\Form;

use Runn\Core\ObjectAsArrayInterface;
use Runn\Core\StdGetSetInterface;
use Runn\Core\StdGetSetTrait;
use Runn\Html\HasNameInterface;
use Runn\Html\HasOptionsInterface;
use Runn\Html\HasTitleInterface;
use Runn\Html\HasValueInterface;
use Runn\Html\HasValueWithValueObjectInterface;
use Runn\Html\HasValueWithValueObjectTrait;

abstract class ElementsGroup
    implements ObjectAsArrayInterface, StdGetSetInterface, ElementInterface, HasValueWithValueObjectInterface
{

    protected static $schema = [];

    /**
     * @return array
     */
    public static function getSchema()
    {
        return static::$schema;
    }

    use StdGetSetTrait {
        innerSet as protected traitInnerSet;
        innerGet as protected traitInnerGet;
    }

    use ElementTrait;
    use HasValueWithValueObjectTrait {
        HasValueWithValueObjectTrait::setValue insteadof ElementTrait;
    }

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

    public function fromSchema($schema = null)
    {
        if (null === $schema) {
            $schema = $this->getSchema();
        }

        foreach ($schema as $key => $element) {

            if (empty($element['class'])) {
                throw new Exception('Invalid group schema: class for element "' . $key  .'" is missing');
            }

            $class = $element['class'];
            if (!is_subclass_of($class, ElementInterface::class)) {
                throw new Exception('Invalid group schema: class for element "' . $key  .'" is not a form element class');
            }

            if (is_subclass_of($class, ElementsGroup::class)) {
                $new = new $class([]);
            } else {
                $new = new $class;
            }

            $this->$key = $new;

            if (is_subclass_of($class, ElementsGroup::class)) {
                $new->fromSchema();
            }

            if ($new instanceof HasNameInterface) {
                $new->setName($element['name'] ?? $key);
            }

            if (($new instanceof HasOptionsInterface) && isset($element['options'])) {
                $new->setOptions($element['options']);
            }

            if (($new instanceof Field) && isset($element['attributes'])) {
                $new->setAttributes($element['attributes']);
                $new->setAttribute('name', $element['name'] ?? $key);
            }

            if (($new instanceof HasTitleInterface) && isset($element['title'])) {
                $new->setTitle($element['title']);
            }

            if (($new instanceof HasValueInterface) && isset($element['value'])) {
                $new->setValue($element['value']);
            }
        }
    }

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
        if (in_array($key, ['parent', 'name', 'title', 'value', 'option', 'form'], true)) {
            $this->__data[$key] = $val;
        } else {
            $this->traitInnerSet($key, $val);
        }
        $val->setParent($this);
    }

    protected function innerGet($key)
    {
        if (in_array($key, ['fullName', 'parent', 'parents', 'name', 'title', 'value', 'option', 'options', 'form', 'templatePath', 'valueObject'], true)) {
            return $this->__data[$key] ?? null;
        } else {
            return $this->traitInnerGet($key);
        }
    }

    /**
     * @return array
     */
    public function getValue()
    {
        $values = [];
        foreach ($this as $key => $el)
        {
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