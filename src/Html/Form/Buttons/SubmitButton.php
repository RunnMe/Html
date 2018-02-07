<?php

namespace Runn\Html\Form\Buttons;

use Runn\Html\Form\Button;

/**
 * Class SubmitButton
 *
 * @package Runn\Html\Form\Buttons
 */
class SubmitButton
    extends Button
{

    public function __construct(string $title = null)
    {
        parent::__construct('submit', $title);
    }

}