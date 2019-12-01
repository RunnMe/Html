<?php

namespace Runn\Html\Form\Fields;

use Runn\Core\Std;
use Runn\Html\Form\Field;

/**
 * <input> tag
 *
 * Class InputField
 * @package Runn\Html\Form\Fields
 */
class InputField
    extends Field
{

    /**
     * @param string $type
     * @return \Runn\Html\Form\Fields\InputField $this
     */
    public function setType(string $type)
    {
        /* set type to first place! */
        $this->setAttributes( (new Std(['type' => $type]))->merge($this->getAttributes() ?: []) );
        return $this;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->getAttributes()->type ?? null;
    }

}
