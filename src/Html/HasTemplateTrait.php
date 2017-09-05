<?php

namespace Runn\Html;

use Runn\Storages\SingleValueStorageInterface;

/**
 * Trait for elements that have template (elements, groups, sets, forms etc)
 *
 * Trait HasTemplateTrait
 * @package Runn\Html
 *
 * @implements \Runn\Html\HasTemplateInterface
 */
trait HasTemplateTrait
    /*implements HasTemplateInterface*/
{

    /** @var mixed|null  */
    protected $template = null;

    /**
     * @param \Runn\Storages\SingleValueStorageInterface|null $template
     * @return $this
     *
     * @7.1
     */
    public function setTemplate(/*?*/SingleValueStorageInterface $template = null)
    {
        $this->template = $template;
        return $this;
    }

    /**
     * @return \Runn\Storages\SingleValueStorageInterface|null
     *
     * @7.1
     */
    public function getTemplate()/*: ?SingleValueStorageInterface*/
    {
        return $this->template;
    }

}