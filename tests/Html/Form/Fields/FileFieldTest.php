<?php

namespace Runn\tests\Html\Form\Fields\FileField;

use Runn\Html\Form\Fields\FileField;
use Runn\Html\Rendering\RenderableInterface;
use PHPUnit\Framework\TestCase;

class FileFieldTest extends TestCase
{

    public function testGetType()
    {
        $field = new FileField();
        $this->assertSame('file', $field->getType());
    }

    public function testRender()
    {
        $field = new FileField();
        $this->assertInstanceOf(RenderableInterface::class, $field);
        $this->assertSame('<input type="file">', $field->render());

        $field = new FileField('foo');
        $this->assertSame('<input type="file" name="foo">', $field->render());

        $field = new FileField('foo', 42);
        $this->assertSame('<input type="file" name="foo" value="42">', $field->render());

        $field = new FileField('foo', 42, ['class'=>'test']);
        $this->assertSame('<input type="file" class="test" name="foo" value="42">', $field->render());
    }

}
