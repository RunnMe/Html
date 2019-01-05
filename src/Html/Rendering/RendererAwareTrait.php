<?php

namespace Runn\Html\Rendering;

use Runn\Html\Rendering\Renderers\NativeRenderer;

/**
 * RendererAwareInterface simplest implementation
 *
 * Trait RendererAwareTrait
 * @package Runn\Html\Rendering
 */
trait RendererAwareTrait
    /*implements RendererAwareInterface*/
{

    /**
     * @var \Runn\Html\Rendering\RendererInterface|null
     */
    protected $renderer;

    /**
     * @param \Runn\Html\Rendering\RendererInterface|null $renderer
     * @return $this
     *
     * @7.1
     */
    public function setRenderer(?RendererInterface $renderer)
    {
        $this->renderer = $renderer;
        return $this;
    }

    /**
     * @return \Runn\Html\Rendering\RendererInterface|null
     *
     * @7.1
     */
    public function getRenderer(): ?RendererInterface
    {
        return $this->renderer ?? new NativeRenderer();
    }

}
