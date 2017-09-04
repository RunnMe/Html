<?php

namespace Runn\Html\Form;

use Runn\Core\Collection;
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
     *
     * @7.1
     */
    public function setParent(/*?*/ElementInterface $parent)
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
     * @return string
     *
     * @7.1
     */
    public function getFullName()/*: ?string*/
    {
        if (null === $this->getName()) {
            return null;
        }

        $parents = $this->getParents();

        if ($parents->empty()) {
            return $this->getName();
        }

        $chain = $parents->append($this);
        $sliced = new Collection();
        foreach ($chain->reverse() as $el) {
            if (null === $el->getName()) {
                break;
            }
            $sliced->prepend($el);
        }
        if (1 === count($sliced)) {
            return $this->getName();
        }

        $names = [];
        $first = $sliced->first();
        foreach ($sliced as $el) {
            if ($el === $first) {
                $names[] = $el->getName();
            } else {
                $names[] = $el->getParent()->searchSame($el);
            }
        }

        return $names[0] . '[' . implode('][', array_slice($names, 1)) . ']';

    }
}
