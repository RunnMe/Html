<?php

namespace Runn\Html\Form\Buttons;

use Runn\Html\Form\Button;

/**
 * Class ResetButton
 *
 * @package Runn\Html\Form\Buttons
 */
class ResetButton
    extends Button
{

    public function __construct(string $title = null)
    {
        parent::__construct('reset', $title);
    }

}