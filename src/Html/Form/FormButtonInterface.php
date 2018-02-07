<?php

namespace Runn\Html\Form;

use Runn\Html\HasAttributesInterface;
use Runn\Html\HasTitleInterface;

/**
 * Common interface for all form buttons
 *
 * Interface FormButtonInterface
 * @package Runn\Html\Form
 */
interface FormButtonInterface
    extends
    FormElementInterface,
    HasAttributesInterface,
    HasTitleInterface
{
}