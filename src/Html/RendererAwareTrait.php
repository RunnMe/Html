<?php

namespace Runn\Html;

use Runn\Html\Renderers\NativeRenderer;

/**
 * RendererAwareInterface simplest implementation
 *
 * Trait RendererAwareTrait
 * @package Runn\Core
 */
trait RendererAwareTrait
    /*implements RendererAwareInterface*/
{

    /**
     * @var \Runn\Html\RendererInterface|null
     */
    protected $renderer;

    /**
     * @param \Runn\Html\RendererInterface|null $renderer
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
     * @return \Runn\Html\RendererInterface|null
     *
     * @7.1
     */
    public function getRenderer(): ?RendererInterface
    {
        return $this->renderer ?? new NativeRenderer();
    }

}