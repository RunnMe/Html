<?php

namespace Runn\Html\Form;

use Runn\Html\HasAttributesInterface;
use Runn\Html\RenderableInterface;

interface FormElementInterface
    extends HasAttributesInterface, ElementHasParentInterface, BelongsToFormInterface, RenderableInterface
{
}