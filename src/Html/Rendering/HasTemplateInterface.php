<?php

namespace Runn\Html\Rendering;

use Runn\Storages\SingleValueStorageInterface;

/**
 * Common interface for all elements that have template (tags, blocks, elements, groups, sets, forms etc)
 *
 * Interface HasTemplateInterface
 * @package Runn\Html
 */
interface HasTemplateInterface
{

    /**
     * @param \Runn\Storages\SingleValueStorageInterface|null $template
     * @return $this
     *
     * @7.1
     */
    public function setTemplate(/*?*/SingleValueStorageInterface $template = null);

    /**
     * @return \Runn\Storages\SingleValueStorageInterface|null
     *
     * @7.1
     */
    public function getTemplate()/*: ?SingleValueStorageInterface*/;

}
