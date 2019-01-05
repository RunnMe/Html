<?php

namespace Runn\Html\Form\Fields;

/**
 * <input type="email"> tag
 *
 * Class EmailField
 * @package Runn\Html\Form\Fields
 */
class EmailField
    extends InputField
{

    /**
     * @param string|null $name
     * @param string|null $value
     * @param iterable|null $attributes
     * @param iterable|null $options
     */
    public function __construct(string $name = null, $value = null, ?iterable $attributes = null, ?iterable $options = null)
    {
        parent::__construct($name, $value, $attributes, $options);
        $this->setType('email');
    }

}
