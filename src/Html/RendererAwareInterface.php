<?php

namespace Runn\Html;

/**
 * Interface RendererAwareInterface
 * @package Runn\Html
 */
interface RendererAwareInterface
{

    /**
     * @param \Runn\Html\RendererInterface|null $renderer
     * @return $this
     */
    public function setRenderer(/*?*/RendererInterface $renderer);

    /**
     * @return \Runn\Html\RendererInterface|null
     */
    public function getRenderer(): /*?*/RendererInterface;

}