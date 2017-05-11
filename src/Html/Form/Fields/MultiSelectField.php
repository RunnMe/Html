<?php

namespace Runn\Html\Form\Fields;

use Runn\Core\Std;
use Runn\Html\RenderableTrait;

/**
 * <select> with <option>s tags with "multiple" attribute
 *
 * Class MultiSelectField
 * @package Runn\Html\Form\Fields
 */
class MultiSelectField
    extends SelectField
{

    use RenderableTrait {
        render as protected traitRender;
    }

    public function __construct($name = null, $value = null, $attributes = null, $options = null)
    {
        parent::__construct($name, $value, $attributes, $options);
        $this->setAttribute('multiple', null);
    }

    /**
     * @param iterable|null $values
     * @return \Runn\Html\Form\Fields\MultiSelectField $this
     */
    public function values(/*iterable */$values = null)
    {
        $this->options->values = new Std;
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