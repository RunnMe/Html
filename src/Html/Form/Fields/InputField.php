<?php

namespace Runn\Html\Form\Fields;

use Runn\Core\Std;
use Runn\Html\Form\Field;
use Runn\Html\Rendering\RenderableTrait;

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
     * @param string $type
     * @return \Runn\Html\Form\Fields\InputField $this
     */
    public function setType(string $type)
    {
        /* set type to first place! */
        $this->attributes = (new Std(['type' => $type]))->merge($this->attributes ?: []);
        return $this;
    }

    /**
     * @return string|null
     *
     * @7.1
     */
    public function getType()/*: ?string*/
    {
        return $this->getAttributes()->type ?? null;
    }

}
