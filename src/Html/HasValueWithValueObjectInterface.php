<?php

namespace Runn\Html;

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
     * @codeCoverageIgnore
     * @return string
     */
    public static function getValueObjectClass(): string;

    /**
     * @return \Runn\ValueObjects\ValueObjectInterface|null
     */
    public function getValueObject()/*: ?ValueObjectInterface*/;

}