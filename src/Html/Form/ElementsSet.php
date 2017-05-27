<?php

namespace Runn\Html\Form;

use Runn\Core\TypedCollection;
use Runn\Html\HasValueInterface;

/**
 * Set of elements with same class
 * Strict typed collection
 *
 * Class ElementsSet
 * @package Runn\Html\Form
 */
abstract class ElementsSet
    extends TypedCollection
    implements ElementInterface
{

    /**
     * @return string
     * @codeCoverageIgnore
     */
    public static function getType()
    {
        return ElementInterface::class;
    }

    protected function checkValueType($value)
    {
        $class = static::getType();
        if (!(is_subclass_of($class, ElementInterface::class))) {
            throw new Exception('Invalid ElementsSet base class "' . $class.'"');
        }
        // turn on strict type check!
        if (!$this->isValueTypeValid($value, true)) {
            throw new Exception('Elements set type mismatch');
        }
    }

    use ElementTrait;

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

}