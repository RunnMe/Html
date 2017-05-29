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

    public function setParent(ElementInterface $parent)
    {
        throw new \BadMethodCallException();
    }

}