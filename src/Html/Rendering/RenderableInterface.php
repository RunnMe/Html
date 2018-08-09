<?php

namespace Runn\Html\Rendering;

/**
 * Common interface for renderable (with template and renderer) objects (tags, blocks, inputs, groups, forms etc)
 *
 * Interface RenderableInterface
 * @package Runn\Html\Rendering
 */
interface RenderableInterface
    extends RendererAwareInterface, HasTemplateInterface
{

    /**
     * @return string
     */
    public function render(): string;

}
