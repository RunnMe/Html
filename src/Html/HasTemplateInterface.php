<?php

namespace Runn\Html;

use Runn\Storages\SingleValueStorageInterface;

/**
 * Common interface for all elements that have template (elements, groups, sets, forms etc)
 *
 * Interface HasTemplateInterface
 * @package Runn\Html
 */
interface HasTemplateInterface
{

    /**
     * @param \Runn\Storages\SingleValueStorageInterface|null $template
     * @return $this
     */
    public function setTemplate(/*?*/SingleValueStorageInterface $template);

    /**
     * @return \Runn\Storages\SingleValueStorageInterface|null
     */
    public function getTemplate(): /*?*/SingleValueStorageInterface;

}