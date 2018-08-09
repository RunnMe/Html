<?php

namespace Runn\Html\Rendering;

use Runn\Fs\File;
use Runn\Storages\SingleValueStorageInterface;

/**
 * Basic trait for renderable objects (inputs, groups, forms etc)
 *
 * Trait RenderableTrait
 * @package Runn\Html\Rendering
 *
 * @implements \Runn\Html\Rendering\RenderableInterface
 *
 * @implements \Runn\Html\RendererAwareInterface
 * @implements \Runn\Html\Rendering\HasTemplateInterface
 */
trait RenderableTrait
    /*implements RenderableInterface*/
{

    use RendererAwareTrait;
    use HasTemplateTrait {
        getTemplate as trait_getTemplate;
    }

    /**
     * @return \Runn\Fs\File|null
     *
     * @7.1
     */
    public function getDefaultTemplate()/*: ?File*/
    {
        $class = get_class($this);
        $reflector = new \ReflectionClass($class);
        do {
            $file = $reflector->getFileName();
            $filename = dirname($file) . '/' . basename($file, '.php') . '.template.php';
            if (is_readable($filename)) {
                return new File($filename);
            }
            $reflector = $reflector->getParentClass();
        } while (false !== $reflector);
        return null;
    }

    /**
     * @return \Runn\Storages\SingleValueStorageInterface|null
     *
     * @7.1
     */
    public function getTemplate()/*: ?SingleValueStorageInterface*/
    {
        $template = $this->trait_getTemplate();
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

        return $this->getRenderer()->render($template, ['this' => $this]);
    }

}
