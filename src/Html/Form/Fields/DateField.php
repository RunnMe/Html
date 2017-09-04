<?php

namespace Runn\Html\Form\Fields;

/**
 * <input type="date"> tag
 *
 * Class DateField
 * @package Runn\Html\Form\Fields
 */
class DateField
    extends InputField
{

    /**
     * @param string|null $name
     * @param string|null $value
     * @param iterable $attributes
     * @param iterable $options
     *
     * @7.1
     */
    public function __construct(string $name = null, $value = null, /*iterable */$attributes = null, /*iterable */$options = null)
    {
        parent::__construct($name, $value, $attributes, $options);
        $this->setType('date');
    }

}