<?php

namespace Runn\Html\Rendering;

use Runn\Storages\SingleValueStorageInterface;

/**
 * Trait for elements that have template (elements, groups, sets, forms etc)
 *
 * Trait HasTemplateTrait
 * @package Runn\Html
 *
 * @implements \Runn\Html\Rendering\HasTemplateInterface
 */
trait HasTemplateTrait
    /*implements HasTemplateInterface*/
{

    /** @var \Runn\Storages\SingleValueStorageInterface|null  */
    protected $template = null;

    /**
     * @param \Runn\Storages\SingleValueStorageInterface|null $template
     * @return $this
     */
    public function setTemplate(?SingleValueStorageInterface $template)
    {
        $this->template = $template;
        return $this;
    }

    /**
     * @return \Runn\Storages\SingleValueStorageInterface|null
     */
    public function getTemplate(): ?SingleValueStorageInterface
    {
        return $this->template;
    }

}
