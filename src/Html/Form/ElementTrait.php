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

    /**
     * Full element's name includes all it's parents names
     * @return string|null
     */
    public function getFullName(): /*?*/string
    {
        // @todo: remove "??" at 7.1
        return $this->getName() ?? '';
    }

}