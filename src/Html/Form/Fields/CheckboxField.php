<?php

namespace Runn\Html\Form\Fields;

/**
 * <input type="checkbox"> tag
 *
 * Class CheckboxField
 * @package Runn\Html\Form\Fields
 */
class CheckboxField
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
        $this->setType('checkbox');
    }

    /**
     * @param bool $val
     * @return $this
     */
    public function setChecked(bool $val = true)
    {
        if ($val) {
            $this->attributes->checked = null;
        } else {
            unset($this->attributes->checked);
        }
        return $this;
    }

    /**
     * @return bool
     */
    public function isChecked(): bool
    {
        return isset($this->attributes->checked);
    }

}