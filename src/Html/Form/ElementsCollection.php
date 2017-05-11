<?php

namespace Runn\Html\Form;

use Runn\Core\TypedCollection;

/**
 * Typed collection of form elements
 *
 * Class ElementsCollection
 * @package Html\Form
 */
class ElementsCollection
    extends TypedCollection
{

    public static function getType()
    {
        return ElementInterface::class;
    }
}