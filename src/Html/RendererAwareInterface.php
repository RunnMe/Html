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
     *
     * @7.1
     */
    public function setRenderer(/*?*/RendererInterface $renderer = null);

    /**
     * @return \Runn\Html\RendererInterface|null
     *
     * @7.1
     */
    public function getRenderer()/*: ?RendererInterface*/;

}
