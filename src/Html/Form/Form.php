<?php

namespace Runn\Html\Form;

use Runn\Html\HasAttributesInterface;
use Runn\Html\HasAttributesTrait;

/**
 * HTML <form>
 *
 * Class Form
 * @package Runn\Html\Form
 */
class Form
    extends ElementsGroup
    implements HasAttributesInterface
{

    use HasAttributesTrait;

    public function setParent(FormElementInterface $parent)
    {
        throw new \BadMethodCallException();
    }

    /**
     * @param string|null $action
     * @return $this
     *
     * @7.1
     */
    public function action(/*?*/string $action = null)
    {
        $this->setAttribute('action', $action);
        return $this;
    }

    /**
     * @param string|null $method
     * @return $this
     *
     * @7.1
     */
    public function method(/*?*/string $method = null)
    {
        $this->setAttribute('method', $method);
        return $this;
    }

}
