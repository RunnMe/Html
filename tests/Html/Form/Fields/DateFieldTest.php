<?php

namespace Runn\tests\Html\Form\Fields\DateField;

use Runn\Html\Form\Fields\DateField;
use Runn\Html\Rendering\RenderableInterface;

class DateFieldTest extends \PHPUnit_Framework_TestCase
{

    public function testGetType()
    {
        $field = new DateField();
        $this->assertSame('date', $field->getType());
    }

    public function testRender()
    {
        $field = new DateField();
        $this->assertInstanceOf(RenderableInterface::class, $field);
        $this->assertSame('<input type="date">', $field->render());

        $field = new DateField('foo');
        $this->assertSame('<input type="date" name="foo">', $field->render());

        $field = new DateField('foo', '2000-01-01');
        $this->assertSame('<input type="date" name="foo" value="2000-01-01">', $field->render());

        $field = new DateField('foo', '2000-01-01', ['class'=>'test']);
        $this->assertSame('<input type="date" class="test" name="foo" value="2000-01-01">', $field->render());
    }

}
