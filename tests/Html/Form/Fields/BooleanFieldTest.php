<?php

namespace Runn\tests\Html\Form\Fields\BooleanField;

use Runn\Html\Form\Fields\BooleanField;
use Runn\Html\Rendering\RenderableInterface;
use PHPUnit\Framework\TestCase;

class BooleanFieldTest extends TestCase
{

    public function testGetType()
    {
        $field = new BooleanField();
        $this->assertSame('checkbox', $field->getType());
    }

    public function testRender()
    {
        $field = new BooleanField();
        $this->assertInstanceOf(RenderableInterface::class, $field);
        $this->assertSame('<input type="hidden" value="0"><input type="checkbox" value="1">', $field->render());

        $field = new BooleanField('foo');
        $this->assertSame('<input type="hidden" name="foo" value="0"><input type="checkbox" name="foo" value="1">', $field->render());

        $field = new BooleanField('foo', true);
        $this->assertTrue($field->isChecked());
        $this->assertSame('<input type="hidden" name="foo" value="0"><input type="checkbox" name="foo" checked value="1">', $field->render());

        $field = new BooleanField('foo', false);
        $this->assertFalse($field->isChecked());
        $this->assertSame('<input type="hidden" name="foo" value="0"><input type="checkbox" name="foo" value="1">', $field->render());

        $field = new BooleanField('foo', 42);
        $this->assertSame('<input type="hidden" name="foo" value="0"><input type="checkbox" name="foo" checked value="1">', $field->render());

        $field = new BooleanField('foo', 0);
        $this->assertFalse($field->isChecked());
        $this->assertSame('<input type="hidden" name="foo" value="0"><input type="checkbox" name="foo" value="1">', $field->render());

        $field = new BooleanField('foo', true, ['class'=>'test']);
        $this->assertSame('<input type="hidden" name="foo" value="0"><input type="checkbox" class="test" name="foo" checked value="1">', $field->render());
    }

}
