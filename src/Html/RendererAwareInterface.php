<?php

namespace Runn\Html;

/**
 * Interface RendererAwareInterface
 * @package Runn\Html
 */
interface RendererAwareInterface
{

    /**
     * @param \Runn\Html\RendererInterface $renderer
     * @return $this
     *
     * @7.1
     */
    public function setRenderer(/*?*/RendererInterface $renderer);

    /**
     * @return \Runn\Html\RendererInterface
     *
     * @7.1
     */
    public function getRenderer(): /*?*/RendererInterface;

}