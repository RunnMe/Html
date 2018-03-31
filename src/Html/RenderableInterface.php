<?php

namespace Runn\Html;

/**
 * Common interface for renderable (with template and renderer) objects (tags, blocks, inputs, groups, forms etc)
 *
 * Interface RenderableInterface
 * @package Runn\Html
 */
interface RenderableInterface
    extends RendererAwareInterface, HasTemplateInterface
{

    /**
     * @return string
     */
    public function render(): string;

}
