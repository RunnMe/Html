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
     */
    public function setRenderer(?RendererInterface $renderer);

    /**
     * @return \Runn\Html\Rendering\RendererInterface|null
     */
    public function getRenderer(): ?RendererInterface;

}
