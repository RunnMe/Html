<?php

namespace Runn\Html\Form;

use Runn\Core\TypedCollection;
use Runn\Html\HasNameInterface;
use Runn\Html\HasNameTrait;
use Runn\Html\HasValueInterface;
use Runn\Html\HasValueTrait;

/**
 * Set of elements with same class
 * Strict typed collection
 *
 * Class ElementsSet
 * @package Runn\Html\Form
 */
abstract class ElementsSet
    extends ElementsCollection
    implements FormElementInterface, HasNameInterface, HasValueInterface
{

    use FormElementTrait;

    use HasNameTrait;

    use HasValueTrait;

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
     *
     * @7.1
     */
    public function setValue(/*iterable */$value)
    {
        // @7.1 delete this because of type hint
        if ( is_array($value) || $value instanceof \Traversable ) {
            foreach ($value as $key => $val) {
                if (isset($this[$key]) && ($this[$key] instanceof HasValueInterface)) {
                    $this[$key]->setValue($val);
                }
            }
        }
        return $this;
    }

}
