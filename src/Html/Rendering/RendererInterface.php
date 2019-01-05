<?php

namespace Runn\Html\Rendering;

use Runn\Storages\SingleValueStorageInterface;

/**
 * Common interface for all renderers (native, Twig, etc...)
 *
 * Interface RendererInterface
 * @package Runn\Html\Rendering
 */
interface RendererInterface
{

    /**
     * @param \Runn\Storages\SingleValueStorageInterface $template
     * @param iterable|null $data
     * @return string
     */
    public function render(SingleValueStorageInterface $template, iterable $data = null): string;

}
