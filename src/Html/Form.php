<?php

namespace Runn\Html;

use Runn\Html\Form\ElementInterface;
use Runn\Html\Form\ElementsGroup;

/**
 * HTML <form>
 *
 * Class Form
 * @package Runn\Html
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