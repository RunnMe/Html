<?php

/** @var \Runn\Html\Form\Fields\SelectField $this */

$attrs = [];

foreach ($this->getAttributes() ?? [] as $key => $val) {
    if (null !== $val) {
        $attrs[] = $key . '="' . $this->escape($val) . '"';
    } else {
        $attrs[] = $key;
    }
}

$html  = '<select' . ($attrs ? ' ' . implode(' ', $attrs) : '') . '>';

$options = [];
foreach ($this->getValues() ?? [] as $key => $val) {
    $options[] =
        '<option value="' . $this->escape($key) . '"' . ($this->getValue() == $val ? ' selected' : '') . '>'
        . $this->escape($val)
        . '</option>';
}

$html .= !empty($options) ? "\n" : '';
$html .= implode("\n", $options);
$html .= !empty($options) ? "\n" : '';

$html .= '</select>' ;

echo $html;