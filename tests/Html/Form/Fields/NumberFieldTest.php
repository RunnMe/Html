<?php

namespace Runn\tests\Html\Form\Fields\NumberField;

use Runn\Html\Form\Fields\NumberField;
use Runn\Html\Rendering\RenderableInterface;
use PHPUnit\Framework\TestCase;

class NumberFieldTest extends TestCase
{

    public function testGetType()
    {
        $field = new NumberField();
        $this->assertSame('number', $field->getType());
    }

    public function testRender()
    {
        $field = new NumberField();
        $this->assertInstanceOf(RenderableInterface::class, $field);
        $this->assertSame('<input type="number">', $field->render());

        $field = new NumberField('foo');
        $this->assertSame('<input type="number" name="foo">', $field->render());

        $field = new NumberField('foo', 42);
        $this->assertSame('<input type="number" name="foo" value="42">', $field->render());

        $field = new NumberField('foo', 42, ['class'=>'test']);
        $this->assertSame('<input type="number" class="test" name="foo" value="42">', $field->render());
    }

}
