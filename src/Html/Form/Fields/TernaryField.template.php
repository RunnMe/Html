<?php

/** @var \Runn\Html\Form\Fields\TernaryField $this */

$attrs = [];
$value = $this->getValue();
if (null === $value) {
    $hiddenvalue = '';
    $hiddenimg = '<img src onerror="this.previousSibling.readOnly=this.previousSibling.indeterminate=true;">';
} else {
    $hiddenvalue = '0';
    $hiddenimg = '';
}

foreach ($this->getAttributes() ?? [] as $key => $val) {
    if ('value' == $key) {
        continue;
    }
    if (null !== $val) {
        $attrs[] = $key . '="' . $this->escape($val) . '"';
    } else {
        $attrs[] = $key;
    }
}

if (null === $value) {
    $attrs[] = 'value=""';
} else {
    $attrs[] = 'value="1"';
}

$attrs[] = 'onclick="if(this.readOnly){this.checked=this.readOnly=false;this.previousSibling.value=\'0\';this.value=1;}else if(!this.checked){this.readOnly=this.indeterminate=true;this.previousSibling.value=\'\';this.value=\'\';}"';

?><input type="hidden"<?php if (!empty($this->getAttribute('name'))): ?> name="<?php echo $this->getAttribute('name'); ?>"<?php endif; ?> value="<?php echo $hiddenvalue; ?>"><input<?php echo $attrs ? ' ' . implode(' ', $attrs) : ''; ?>><?php echo $hiddenimg; ?>