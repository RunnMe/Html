<?php

namespace Runn\Html;

use Runn\Storages\SingleValueStorageInterface;

/**
 * Common interface for all renderers (native, Twig, etc...)
 *
 * Interface RendererInterface
 * @package Runn\Html
 */
interface RendererInterface
{

    /**
     * @param \Runn\Storages\SingleValueStorageInterface $template
     * @param iterable|null $data
     * @return string
     *
     * @7.1
     */
    public function render(SingleValueStorageInterface $template, /*iterable */$data = null): string;

}
