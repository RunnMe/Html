<?php

namespace Runn\tests\Html\Form\Fields\CheckboxField;

use Runn\Html\Form\Fields\CheckboxField;
use Runn\Html\Form\Fields\TextField;
use Runn\Html\RenderableInterface;

class CheckboxFieldTest extends \PHPUnit_Framework_TestCase
{

    public function testGetType()
    {
        $field = new CheckboxField();
        $this->assertSame('checkbox', $field->getType());
    }

    public function testRender()
    {
        $field = new CheckboxField();
        $this->assertInstanceOf(RenderableInterface::class, $field);
        $this->assertSame('<input type="checkbox">', $field->render());

        $field = new CheckboxField('foo');
        $this->assertSame('<input type="checkbox" name="foo">', $field->render());

        $field = new CheckboxField('foo', 42);
        $this->assertSame('<input type="checkbox" name="foo" value="42">', $field->render());

        $field = new CheckboxField('foo', 42, ['class'=>'test']);
        $this->assertSame('<input type="checkbox" class="test" name="foo" value="42">', $field->render());

        $field = new CheckboxField('foo', 42);
        $this->assertFalse($field->isChecked());
        $this->assertSame('<input type="checkbox" name="foo" value="42">', $field->render());

        $field->setChecked();
        $this->assertTrue($field->isChecked());
        $this->assertNull($field->getAttributes()->checked);

        $field->setChecked(true);
        $this->assertTrue($field->isChecked());
        $this->assertNull($field->getAttributes()->checked);

        $this->assertSame('<input type="checkbox" name="foo" checked value="42">', $field->render());

        $field->setChecked(false);
        $this->assertFalse($field->isChecked());
        $this->assertFalse(isset($field->getAttributes()->checked));
    }

}