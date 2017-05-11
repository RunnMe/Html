<?php

namespace Runn\Html\Form\Fields;

use Runn\Core\Std;
use Runn\Html\Form\Field;
use Runn\Html\RenderableTrait;

/**
 * <select> with <option>s tags
 *
 * Class SelectField
 * @package Runn\Html\Form\Fields
 */
class SelectField
    extends Field
{

    use RenderableTrait {
        render as protected traitRender;
    }

    /**
     * @param iterable|null $values
     * @return \Runn\Html\Form\Fields\SelectField $this
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