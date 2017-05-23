<?php

namespace Runn\Html;

use Runn\Fs\File;
use Runn\Storages\SingleValueStorageInterface;

/**
 * Basic trait for renderable objects (inputs, groups, forms etc)
 *
 * Trait RenderableTrait
 * @package Runn\Html
 *
 * @implements \Runn\Html\RenderableInterface
 *
 * @implements \Runn\Html\RendererAwareInterface
 * @implements \Runn\Html\HasTemplateInterface
 */
trait RenderableTrait
    /*implements RenderableInterface*/
{

    use RendererAwareTrait;
    use HasTemplateTrait {
        getTemplate as traitGetTemplate;
    }

    /**
     * @return \Runn\Fs\File|null
     */
    public function getDefaultTemplate()/*: ?string*/
    {
        $reflector = new \ReflectionClass(get_class($this));
        $file = $reflector->getFileName();
        $filename = dirname($file) . '/' . basename($file, '.php') . '.template.html';
        if (is_readable($filename)) {
            return new File($filename);
        } else {
            return null;
        }
    }

    public function getTemplate()/*: ?SingleValueStorageInterface*/
    {
        $template = $this->traitGetTemplate();
        if (null === $template) {
            return $this->getDefaultTemplate();
        }
        return $template;
    }

    /**
     * @param \Runn\Storages\SingleValueStorageInterface|null $template
     * @return string
     */
    public function render(SingleValueStorageInterface $template = null): string
    {
        $template = $template ?: $this->getTemplate();
        if (empty($template)) {
            return '';
        }

        return $this->getRenderer()->render(['this' => $this], $template);
    }

}