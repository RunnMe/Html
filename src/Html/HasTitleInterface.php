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
     *
     * @7.1
     */
    public function setTitle(?string $title);

    /**
     * @return string|null
     *
     * @7.1
     */
    public function getTitle(): ?string;

}