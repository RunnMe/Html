<?php

namespace Runn\Html\Form\Fields;

/**
 * <input type="hidden"> tag
 *
 * Class HiddenField
 * @package Runn\Html\Form\Fields
 */
class HiddenField
    extends InputField
{

    /**
     * @param string|null $name
     * @param string|null $value
     * @param iterable $attributes
     * @param iterable $options
     */
    public function __construct(string $name = null, $value = null, /*iterable */$attributes = null, /*iterable */$options = null)
    {
        parent::__construct($name, $value, $attributes, $options);
        $this->setType('hidden');
    }

}