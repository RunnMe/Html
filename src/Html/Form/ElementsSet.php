<?php

namespace Runn\Html\Form;

use Runn\Core\ObjectAsArrayInterface;
use Runn\Core\ObjectAsArrayTrait;
use Runn\Html\HasValueInterface;

/**
 * Set of elements with same class
 * It is not collection! Classes must be a same, not inherited!
 *
 * Class ElementsSet
 * @package Runn\Html\Form
 */
abstract class ElementsSet
    implements ObjectAsArrayInterface, ElementInterface
{

    protected static $elementsType = ElementInterface::class;
    protected static $elementsName = null;

    /**
     * @return string
     */
    public static function getElementsType()
    {
        return static::$elementsType;
    }

    use ObjectAsArrayTrait {
        innerSet as protected traitInnerSet;
    }

    use ElementTrait;

    /**
     * @param $key
     * @param $val
     * @throws \Runn\Html\Form\Exception
     */
    protected function innerSet($key, $val)
    {
        if (!(null === $key || is_numeric($key))) {
            throw new Exception('Invalid ElementsSet (' . static::class . ') key: "' . $key . '"');
        }

        $class = static::getElementsType();
        if (!(is_subclass_of($class, ElementInterface::class))) {
            throw new Exception('Invalid ElementsSet base class "' . $class.'"');
        }
        if (!(is_object($val) && get_class($val) == $class)) {
            throw new Exception('Invalid class for element "' . $key  .'"');
        }

        $this->traitInnerSet($key, $val);
        $val->setParent($this);
    }

    /**
     * @param int $count
     * @param array ...$args
     */
    public function add($count = 1, ...$args)
    {
        for($i = 1; $i<=$count; $i++) {
            $class = static::getElementsType();
            $element = new $class(...$args);
            if (!empty(static::$elementsName)) {
                $element->setName(static::$elementsName);
            }
            $this[] = $element;
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

}