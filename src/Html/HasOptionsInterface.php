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
     * @param string $key
     * @param mixed $val
     * @return $this
     */
    public function setOption(string $key, $val);

    /**
     * @param string $key
     * @return mixed|null
     */
    public function getOption(string $key);

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
