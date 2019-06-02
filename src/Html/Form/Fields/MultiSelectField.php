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
     * @param iterable|null $attributes
     * @param iterable|null $options
     */
    public function __construct(string $name = null, $value = null, ?iterable $attributes = null, ?iterable $options = null)
    {
        parent::__construct($name, $value, $attributes, $options);
        $this->setAttribute('multiple', null);
    }

}
