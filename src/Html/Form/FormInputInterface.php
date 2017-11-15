<?php

namespace Runn\Html\Form;

use Runn\Html\HasAttributesInterface;
use Runn\Html\HasNameInterface;
use Runn\Html\HasOptionsInterface;
use Runn\Html\HasTitleInterface;
use Runn\Html\HasValueInterface;

/**
 * Common interface for all form inputs: fields, input sets and groups
 *
 * Interface FormInputInterface
 * @package Runn\Html\Form
 */
interface FormInputInterface
    extends
    FormElementInterface,
    HasAttributesInterface,
    HasTitleInterface, HasNameInterface, HasValueInterface,
    HasOptionsInterface
{

    /**
     * Full element's name includes all it's parents names
     * @return string|null
     *
     * @7.1
     */
    public function getFullName()/*: ?string*/;

}