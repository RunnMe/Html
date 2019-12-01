<?php

use function Runn\Html\Rendering\escape;

/** @var \Runn\Html\Form\Button $this */

$attrs = [];

foreach ($this->getAttributes() ?? [] as $key => $val) {
    if (null !== $val) {
        $attrs[] = $key . '="' . escape($val) . '"';
    } else {
        $attrs[] = $key;
    }
}

?><button<?php echo $attrs ? ' ' . implode(' ', $attrs) : ''; ?>><?php echo escape($this->getTitle() ?? ''); ?></button>