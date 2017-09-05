<?php

namespace Runn\Html;

use Runn\ValueObjects\ValueObjectInterface;

/**
 * Common interface for all elements that have value (like form inputs) and can cast it to Value Object
 *
 * Interface HasValueWithValueObjectInterface
 * @package Runn\Html
 */
interface HasValueWithValueObjectInterface
    extends HasValueInterface
{

    /**
     * @return string
     */
    public static function getValueObjectClass(): string;

    /**
     * @return \Runn\ValueObjects\ValueObjectInterface|null
     *
     * @7.1
     */
    public function getValueObject()/*: ?ValueObjectInterface*/;

}