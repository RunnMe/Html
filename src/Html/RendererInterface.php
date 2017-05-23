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
     * @param iterable $data
     * @param \Runn\Storages\SingleValueStorageInterface $template
     * @return string
     */
    public function render(/*iterable */$data, SingleValueStorageInterface $template): string;

}