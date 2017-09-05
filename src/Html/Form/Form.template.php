<form>
<?php
foreach ($this as $key => $element):
?>
    <?php
    if ($element instanceof \Runn\Html\HasNameInterface && empty($element->getName())) {
        $element->setName($key);
    }
    ?>
    <?php echo $element->render(); ?>

<?php
endforeach;
?>
</form>