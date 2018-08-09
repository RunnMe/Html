<?php

namespace Runn\Html\Rendering;

/**
 * Interface RendererAwareInterface
 * @package Runn\Html\Rendering
 */
interface RendererAwareInterface
{

    /**
     * @param \Runn\Html\Rendering\RendererInterface|null $renderer
     * @return $this
     *
     * @7.1
     */
    public function setRenderer(/*?*/RendererInterface $renderer = null);

    /**
     * @return \Runn\Html\Rendering\RendererInterface|null
     *
     * @7.1
     */
    public function getRenderer()/*: ?RendererInterface*/;

}
