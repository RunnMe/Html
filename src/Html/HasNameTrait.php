<?php

namespace Runn\Html;

use Runn\Core\Collection;
use Runn\Html\Form\ElementHasParentInterface;

/**
 * Trait for elements that have name (like form inputs)
 *
 * Trait HasNameTrait
 * @package Runn\Html
 *
 * @implements \Runn\Html\HasNameInterface
 */
trait HasNameTrait
    /*implements HasNameInterface*/
{

    /** @var string|null  */
    protected $__name = null;

    /**
     * @param string|null $name
     * @return $this
     */
    public function setName(?string $name)
    {
        $this->__name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->__name;
    }

    /**
     * Full element's name includes all it's parents names
     * @return string|null
     */
    public function getFullName(): ?string
    {
        if (null === $this->getName()) {
            return null;
        }

        if (!($this instanceof ElementHasParentInterface)) {
            return $this->getName();
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
