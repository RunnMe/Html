<?php

/** @var \Runn\Html\Form\Form $this */

$attrs = [];

foreach ($this->getAttributes() ?? [] as $key => $val) {
    if (null !== $val) {
        // @todo: escape method!
        $attrs[] = $key . '="' . htmlspecialchars($val) . '"';
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