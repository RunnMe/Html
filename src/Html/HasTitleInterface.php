<?php

namespace Runn\Html;

/**
 * Common interface for all elements that have visible title (like inputs with labels)
 *
 * Interface HasTitleInterface
 * @package Runn\Html
 */
interface HasTitleInterface
{

    /**
     * @param string|null $title
     * @return $this
     */
    public function setTitle(?string $title);

    /**
     * @return string|null
     */
    public function getTitle(): ?string;

}
