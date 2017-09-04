<?php

namespace Runn\Html;

/**
 * Common interface for all elements that have name (like form inputs)
 *
 * Interface HasNameInterface
 * @package Runn\Html
 */
interface HasNameInterface
{

    /**
     * @param string|null $name
     * @return $this
     *
     * @7.1
     */
    public function setName(?string $name);

    /**
     * @return string|null
     *
     * @7.1
     */
    public function getName(): ?string;

}