<?php

namespace Runn\Html;

/**
 * Common interface for all elements that have value (like form inputs)
 *
 * Interface HasValueInterface
 * @package Runn\Html
 */
interface HasValueInterface
{

    /**
     * @param mixed $value
     * @return $this
     */
    public function setValue($value);

    /**
     * @return mixed
     */
    public function getValue();

}