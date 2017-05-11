<?php

namespace Runn\Html;

/**
 * Trait RenderableTrait
 * @package Runn\Html
 *
 * @implements \Runn\Html\RenderableInterface
 */
trait RenderableTrait
    /*implements RenderableInterface*/
{

    public function getTemplatePath()/*: ?string*/
    {
        $reflector = new \ReflectionClass(get_class($this));
        $file = $reflector->getFileName();
        return dirname($file) . '/' . basename($file, '.php') . '.template.html';
    }

    /**
     * @param string|null $template
     * @return string
     */
    public function render(string $template = null): string
    {
        $template = $template ?: $this->getTemplatePath();
        if (empty($template)) {
            return '';
        }

        ob_start();
        @include $template;
        $contents = ob_get_contents();
        ob_end_clean();

        return $contents;
    }

}