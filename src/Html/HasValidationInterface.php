<?php

namespace Runn\Html;

/**
 * Common interface for all elements that have value, it's validation and store errors
 *
 * Interface HasValidationInterface
 * @package Runn\Html
 */
interface HasValidationInterface extends HasValueInterface
{

    /**
     * Makes value validation
     *
     * Returns true if there are no validation errors, false otherwise
     * @return bool
     */
    public function validate(): bool;

    /**
     * Returns validation errors collection
     *
     * @return \Runn\Html\ValidationErrors
     */
    public function errors(): ValidationErrors;

}
