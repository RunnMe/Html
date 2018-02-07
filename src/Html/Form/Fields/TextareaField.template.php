<?php

/** @var \Runn\Html\Form\Fields\TextareaField $this */

$attrs = [];

foreach ($this->getAttributes() ?? [] as $key => $val) {
    if (null !== $val) {
        $attrs[] = $key . '="' . $this->escape($val) . '"';
    } else {
        $attrs[] = $key;
    }
}

$value = $this->getValue();
if (null === $value) {
    $value = '';
}

?><textarea<?php echo $attrs ? ' ' . implode(' ', $attrs) : ''; ?>><?php echo $this->escape($value); ?></textarea>