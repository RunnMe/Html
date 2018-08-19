<?php

namespace Runn\Html;

use Runn\Validation\ValidatorAwareInterface;

/**
 * Common interface for all elements that have value, it's validation and store errors
 *
 * Interface HasValueValidationInterface
 * @package Runn\Html
 */
interface HasValueValidationInterface extends HasValueInterface, ValidatorAwareInterface
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
