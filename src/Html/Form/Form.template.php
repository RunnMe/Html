<?php

use function Runn\Html\Rendering\escape;

/** @var \Runn\Html\Form\Form $this */

$attrs = [];

foreach ($this->getAttributes() ?? [] as $key => $val) {
    if (null !== $val) {
        $attrs[] = $key . '="' . escape($val) . '"';
    } else {
        $attrs[] = $key;
    }
}

?>
<form<?php echo $attrs ? ' ' . implode(' ', $attrs) : ''; ?>>
<?php
foreach ($this as $key => $element):
?>
    <?php
    if ($element instanceof \Runn\Html\HasNameInterface && empty($element->getName())) {
        $element->setName($key);
    }
    echo $element->render();
    ?>

<?php
endforeach;
?>
</form>