<?php

namespace Runn\Html\Form\Fields;

/**
 * <input type="checkbox"> tag with true/false value
 *
 * Class BooleanField
 * @package Runn\Html\Form\Fields
 */
class BooleanField
    extends CheckboxField
{

    public function setValue($val)
    {
        $val = (bool)$val;
        $this->setChecked($val);
        $val = (int)$val;
        return parent::setValue($val);
    }

}