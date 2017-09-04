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
     * @param string|int $key
     * @param mixed $val
     * @return $this
     */
    public function setOption($key, $val)
    {
        if (null === $this->options) {
            $this->options = new Std;
        }
        $this->options->$key = $val;
        return $this;
    }

    /**
     * @param string|int $key
     * @return mixed|null
     */
    public function getOption($key)
    {
        return $this->options->$key ?? null;
    }

    /**
     * @param iterable|null $options
     * @return $this
     *
     * @7.1
     */
    public function setOptions(/*iterable */$options = null)
    {
        $this->options = new Std;
        if (null !== $options) {
            foreach ($options as $key => $val) {
                $this->setOption($key, $val);
            }
        }
        return $this;
    }

    /**
     * @return \Runn\Core\Std|null
     *
     * @7.1
     */
    public function getOptions()/*: ?\Runn\Core\Std*/
    {
        return $this->options;
    }

}