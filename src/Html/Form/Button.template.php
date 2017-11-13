<?php

/** @var \Runn\Html\Form\Button $this */

$attrs = [];

foreach ($this->getAttributes() ?? [] as $key => $val) {
    if (null !== $val) {
        // @todo: escape method!
        $attrs[] = $key . '="' . $this->escape($val) . '"';
    } else {
        $attrs[] = $key;
    }
}

?><button<?php echo $attrs ? ' ' . implode(' ', $attrs) : ''; ?>><?php echo $this->escape($this->getTitle()); ?></button>