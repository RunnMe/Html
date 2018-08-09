<?php

namespace Runn\tests\Html\Form\Fields\InputField;

use Runn\Fs\File;
use Runn\Html\Form\Fields\InputField;
use Runn\Html\Rendering\RenderableInterface;

class InputFieldTest extends \PHPUnit_Framework_TestCase
{

    public function testSetGetType()
    {
        $field = new InputField();

        $this->assertNull($field->getType());

        $field->setType('text');

        $this->assertSame('text', $field->getAttributes()->type);
        $this->assertSame('text', $field->getType());
    }

    public function testRender()
    {
        $field = new InputField();
        $this->assertInstanceOf(RenderableInterface::class, $field);
        $this->assertSame('<input>', $field->render());

        $field = new InputField('foo');
        $this->assertSame('<input name="foo">', $field->render());

        $field = new InputField('foo', 42);
        $this->assertSame('<input name="foo" value="42">', $field->render());

        $field = new InputField('foo', 42, ['class'=>'test']);
        $this->assertSame('<input class="test" name="foo" value="42">', $field->render());

        $field = (new InputField('foo', 42, ['class'=>'test']))->setType('text');
        $this->assertSame('<input type="text" class="test" name="foo" value="42">', $field->render());

        $field = (new InputField('foo', 42, ['type' => 'text', 'class'=>'test']));
        $this->assertSame('<input type="text" class="test" name="foo" value="42">', $field->render());
    }

    public function testRenderTemplate()
    {
        $filename = sys_get_temp_dir() . '/FsTest_save.php';
        file_put_contents($filename, 'Render: <?php echo $this->getName(); ?>=<?php echo $this->getValue(); ?>');

        $field = new InputField('foo', 42);
        $this->assertSame('Render: foo=42', $field->render(new File($filename)));

        unlink($filename);
    }

}
