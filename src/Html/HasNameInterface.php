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
     * @param string $name
     * @return $this
     */
    public function setName(string $name);

    /**
     * @return string|null
     */
    public function getName()/*: ?string*/;

}