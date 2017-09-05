<?php

namespace Runn\Html;

/**
 * Common interface for all elements that have some options (any element, any options, not tag attributes!)
 *
 * Interface HasOptionsInterface
 * @package Runn\Html
 */
interface HasOptionsInterface
{

    /**
     * @param string|int $key
     * @param mixed $val
     * @return $this
     */
    public function setOption($key, $val);

    /**
     * @param string|int $key
     * @return mixed|null
     */
    public function getOption($key);

    /**
     * @param iterable|null $options
     * @return $this
     *
     * @7.1
     */
    public function setOptions(iterable $options = null);

    /**
     * @return \Runn\Core\Std
     *
     * @7.1
     */
    public function getOptions(): ?\Runn\Core\Std;

}