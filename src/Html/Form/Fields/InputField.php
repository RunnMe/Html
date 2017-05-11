<?php

namespace Runn\Html\Form\Fields;

use Runn\Core\Std;
use Runn\Html\Form\Field;
use Runn\Html\RenderableTrait;

/**
 * <input> tag
 *
 * Class InputField
 * @package Runn\Html\Form\Fields
 */
class InputField
    extends Field
{

    use RenderableTrait;

    /**
     * @param string $val
     * @return \Runn\Html\Form\Fields\InputField $this
     */
    public function setType(string $val)
    {
        /* set type to first place! */
        $this->attributes = (new Std(['type' => $val]))->merge($this->attributes ?: []);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getType()/*: ?string*/
    {
        return $this->getAttributes()->type ?? null;
    }

}