<?php

namespace Runn\Html;

/**
 * Common interface for renderable objects (inputs, groups, forms etc)
 *
 * Interface RenderableInterface
 * @package Runn\Html
 */
interface RenderableInterface
{

    /**
     * @return string|null
     */
    public function getTemplatePath()/*: ?string*/;

    /**
     * @param string|null $template
     * @return string
     */
    public function render(string $template = null): string;

}