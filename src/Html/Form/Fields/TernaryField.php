<?php

namespace Runn\Html\Form\Fields;

/**
 * <input type="checkbox"> tag with true/false/null value
 * null value is the empty string in HTTP
 *
 * Class TernaryField
 * @package Runn\Html\Form\Fields
 */
class TernaryField
    extends CheckboxField
{

    /**
     * @param \Runn\ValueObjects\SingleValueObject|string $val
     * @return \Runn\Html\Form\Field $this
     */
    public function setValue($val)
    {
        $val = (null === $val || '' === $val) ? null : (bool)$val;
        if (true === $val) {
            $this->setChecked(true);
        }
        return parent::setValue(null === $val ? $val : (int)$val);
    }

}