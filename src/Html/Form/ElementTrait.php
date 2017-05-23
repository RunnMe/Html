<?php

namespace Runn\Html\Form;

use Runn\Html\BelongsToFormTrait;
use Runn\Html\Form;
use Runn\Html\HasNameTrait;
use Runn\Html\HasOptionsTrait;
use Runn\Html\HasTitleTrait;
use Runn\Html\HasValueTrait;
use Runn\Html\RenderableTrait;

/**
 * Class ElementTrait
 * @package Runn\Html
 *
 * @implements \Runn\Html\Form\ElementInterface
 *
 * @implements \Runn\Html\HasNameInterface
 * @implements \Runn\Html\HasTitleInterface
 * @implements \Runn\Html\HasValueInterface
 * @implements \Runn\Html\HasOptionsInterface
 * @implements \Runn\Html\BelongsToFormInterface
 * @implements \Runn\Html\RenderableInterface
 */
trait ElementTrait
    /*implements ElementInterface*/
{

    use HasNameTrait;
    use HasTitleTrait;
    use HasValueTrait;
    use HasOptionsTrait;

    use ElementHasParentTrait {
        setParent as traitSetParent;
    }
    use BelongsToFormTrait;

    use RenderableTrait;

    /**
     * @return string|null
     */
    public function getNameHash()/*: ?string*/
    {
        $name = $this->getName();
        if (null === $name) {
            return null;
        }

        return sha1(implode('+', $this->getParents()->collect(function ($x) {return $x->getName();})) . '+' . $name);
    }

    /**
     * @param \Runn\Html\Form\ElementInterface $parent
     * @return $this
     */
    public function setParent(ElementInterface $parent)
    {
        if ($parent instanceof Form) {
            $this->setForm($parent);
        } elseif ($parent->belongsToForm()) {
            $this->setForm($parent->getForm());
        }
        return $this->traitSetParent($parent);
    }

}