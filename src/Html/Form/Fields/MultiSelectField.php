<?php

namespace Runn\Html\Form\Fields;

use Runn\Core\Std;

/**
 * <select> with <option>s tags with "multiple" attribute
 *
 * Class MultiSelectField
 * @package Runn\Html\Form\Fields
 */
class MultiSelectField
    extends SelectField
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
        $this->setAttribute('multiple', null);
    }

    /**
     * @param iterable|null $values
     * @return \Runn\Html\Form\Fields\MultiSelectField $this
     *
     * @7.1
     */
    public function values(/*iterable */$values = null)
    {
        $this->setOption('values', new Std);
        if (null !== $values) {
            foreach ($values as $key => $val) {
                $this->options->values[$key] = $val;
            }
        }
        return $this;
    }

    /**
     * @return \Runn\Core\Std
     */
    public function getValues()
    {
        return $this->options->values ?? [];
    }

}
