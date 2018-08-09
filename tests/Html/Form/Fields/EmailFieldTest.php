<?php

namespace Runn\tests\Html\Form\Fields\EmailField;

use Runn\Html\Form\Fields\EmailField;
use Runn\Html\Rendering\RenderableInterface;

class EmailFieldTest extends \PHPUnit_Framework_TestCase
{

    public function testGetType()
    {
        $field = new EmailField();
        $this->assertSame('email', $field->getType());
    }

    public function testRender()
    {
        $field = new EmailField();
        $this->assertInstanceOf(RenderableInterface::class, $field);
        $this->assertSame('<input type="email">', $field->render());

        $field = new EmailField('foo');
        $this->assertSame('<input type="email" name="foo">', $field->render());

        $field = new EmailField('foo', 42);
        $this->assertSame('<input type="email" name="foo" value="42">', $field->render());

        $field = new EmailField('foo', 42, ['class'=>'test']);
        $this->assertSame('<input type="email" class="test" name="foo" value="42">', $field->render());
    }

}
