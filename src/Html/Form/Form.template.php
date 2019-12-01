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
    /** @var \Runn\Html\Form\FormElementInterface $element */
?>
    <?php

    if ($element instanceof \Runn\Html\HasNameInterface && empty($element->getName())) {
        $element->setName($key);
    }

    if ($element instanceof \Runn\Html\HasValueValidationInterface && !$element->errors()->empty()):
        foreach ($element->errors() as $error):
            echo $error->getMessage()?><br><?php
        endforeach;
    endif;

    echo $element->render();

    ?>

<?php
endforeach;
?>
</form>