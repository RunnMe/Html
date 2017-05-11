<?php

namespace Runn\tests\Html\Form\Fields\TextareaField;

use Runn\Html\Form\Fields\TextareaField;
use Runn\Html\RenderableInterface;

class TextareaFieldTest extends \PHPUnit_Framework_TestCase
{

    public function testRender()
    {
        $field = new TextareaField();
        $this->assertInstanceOf(RenderableInterface::class, $field);
        $this->assertSame('<textarea></textarea>', $field->render());

        $field = new TextareaField('foo');
        $this->assertSame('<textarea name="foo"></textarea>', $field->render());

        $field = new TextareaField('foo', 42);
        $this->assertSame('<textarea name="foo">42</textarea>', $field->render());

        $field = new TextareaField('foo', 42, ['class'=>'test']);
        $this->assertSame('<textarea class="test" name="foo">42</textarea>', $field->render());

        $field = new TextareaField('foo', '"some text"', ['class'=>'test']);
        $this->assertSame('<textarea class="test" name="foo">&quot;some text&quot;</textarea>', $field->render());
    }

    public function testRenderTemplate()
    {
        $filename = sys_get_temp_dir() . '/FsTest_save.php';
        file_put_contents($filename, 'Render: <?php echo $this->getName(); ?>=<?php echo $this->getValue(); ?>');

        $field = new TextareaField('foo', 42);
        $this->assertSame('Render: foo=42', $field->render($filename));

        unlink($filename);
    }

}