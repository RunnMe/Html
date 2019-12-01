<?php

use function Runn\Html\Rendering\escape;

/** @var \Runn\Html\Form\Fields\BooleanField $this */

$attrs = [];

foreach ($this->getAttributes() ?? [] as $key => $val) {
    if ('value' == $key) {
        continue;
    }
    if (null !== $val) {
        $attrs[] = $key . '="' . escape($val) . '"';
    } else {
        $attrs[] = $key;
    }
}
$attrs[] = 'value="1"';

?><input type="hidden"<?php if (!empty($this->getAttribute('name'))): ?> name="<?php echo $this->getAttribute('name'); ?>"<?php endif; ?> value="0"><input<?php echo $attrs ? ' ' . implode(' ', $attrs) : ''; ?>>