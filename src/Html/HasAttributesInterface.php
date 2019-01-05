<?php

namespace Runn\Html;

/**
 * Common interface for all elements that have html attributes (forms, form inputs, another html tags)
 *
 * Interface HasAttributesInterface
 * @package Runn\Html
 */
interface HasAttributesInterface
{

    /**
     * @param string $key
     * @param string|null $val
     * @return $this
     *
     * @7.1
     */
    public function setAttribute(string $key, ?string $val);

    /**
     * @param string $key
     * @return string|null
     *
     * @7.1
     */
    public function getAttribute(string $key): ?string;

    /**
     * @param iterable|null $attributes
     * @return $this
     *
     * @7.1
     */
    public function setAttributes(iterable $attributes = null);

    /**
     * @return \Runn\Core\Std
     *
     * @7.1
     */
    public function getAttributes(): ?\Runn\Core\Std;

}
