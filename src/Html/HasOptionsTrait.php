<?php

namespace Runn\Html;

use Runn\Core\Std;

/**
 * Trait for all elements that have some options (any element, any options, not tag attributes!)
 *
 * Trait HasOptionsTrait
 * @package Runn\Html
 *
 * @implements \Runn\Html\HasOptionsInterface
 */
trait HasOptionsTrait
    /*implements HasOptionsInterface*/
{

    /** @var \Runn\Core\Std|null  */
    protected $options = null;

    /**
     * @param string $key
     * @param mixed $val
     * @return $this
     */
    public function setOption(string $key, $val)
    {
        if (null === $this->options) {
            $this->options = new Std;
        }
        $this->options->$key = $val;
        return $this;
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    public function getOption(string $key)
    {
        return $this->options->$key ?? null;
    }

    /**
     * @param iterable|null $options
     * @return $this
     */
    public function setOptions(?iterable $options = null)
    {
        if (null === $options) {
            $this->options = null;
            return $this;
        }
        $this->options = new Std;
        foreach ($options as $key => $val) {
            $this->setOption($key, $val);
        }
        return $this;
    }

    /**
     * @return \Runn\Core\Std|null
     */
    public function getOptions(): ?\Runn\Core\Std
    {
        return $this->options;
    }

}
