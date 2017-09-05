<?php

/** @var \Runn\Html\Form\Fields\InputField $this */

$attrs = [];

foreach ($this->getAttributes() ?? [] as $key => $val) {
    if (null !== $val) {
        $attrs[] = $key . '="' . $this->escape($val) . '"';
    } else {
        $attrs[] = $key;
    }
}

if (null !== ($value = $this->getValue())) {
    $attrs[] = 'value="' . $this->escape($value) . '"';
}
?><input<?php echo $attrs ? ' ' . implode(' ', $attrs) : ''; ?>>