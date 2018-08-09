<?php

namespace Runn\tests\Html\Form\Fields\TextField;

use Runn\Html\Form\Fields\TextField;
use Runn\Html\Rendering\RenderableInterface;

class TextFieldTest extends \PHPUnit_Framework_TestCase
{

    public function testGetType()
    {
        $field = new TextField();
        $this->assertSame('text', $field->getType());
    }

    public function testRender()
    {
        $field = new TextField();
        $this->assertInstanceOf(RenderableInterface::class, $field);
        $this->assertSame('<input type="text">', $field->render());

        $field = new TextField('foo');
        $this->assertSame('<input type="text" name="foo">', $field->render());

        $field = new TextField('foo', 42);
        $this->assertSame('<input type="text" name="foo" value="42">', $field->render());

        $field = new TextField('foo', 42, ['class'=>'test']);
        $this->assertSame('<input type="text" class="test" name="foo" value="42">', $field->render());
    }

}
