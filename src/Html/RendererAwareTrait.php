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
{

    /**
     * @var \Runn\Html\RendererInterface|null
     */
    protected $renderer;

    /**
     * @param \Runn\Html\RendererInterface|null $renderer
     * @return $this
     */
    public function setRenderer(/*?*/RendererInterface $renderer)
    {
        $this->renderer = $renderer;
        return $this;
    }

    /**
     * @return \Runn\Html\RendererInterface
     */
    public function getRenderer(): RendererInterface
    {
        return $this->renderer ?? new NativeRenderer();
    }

}