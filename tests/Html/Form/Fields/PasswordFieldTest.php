<?php

namespace Runn\tests\Html\Form\Fields\PasswordField;

use PHPUnit\Framework\TestCase;
use Runn\Html\Form\Fields\PasswordField;
use Runn\Html\Rendering\RenderableInterface;

class PasswordFieldTest extends TestCase
{

    public function testGetType()
    {
        $field = new PasswordField();
        $this->assertSame('password', $field->getType());
    }

    public function testRender()
    {
        $field = new PasswordField();
        $this->assertInstanceOf(RenderableInterface::class, $field);
        $this->assertSame('<input type="password">', $field->render());

        $field = new PasswordField('foo');
        $this->assertSame('<input type="password" name="foo">', $field->render());

        $field = new PasswordField('foo', 42);
        $this->assertSame('<input type="password" name="foo" value="42">', $field->render());

        $field = new PasswordField('foo', 42, ['class'=>'test']);
        $this->assertSame('<input type="password" class="test" name="foo" value="42">', $field->render());
    }

}
