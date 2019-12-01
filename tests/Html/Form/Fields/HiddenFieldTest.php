<?php

namespace Runn\tests\Html\Form\Fields\HiddenField;

use PHPUnit\Framework\TestCase;
use Runn\Html\Form\Fields\HiddenField;
use Runn\Html\Rendering\RenderableInterface;

class HiddenFieldTest extends TestCase
{

    public function testGetType()
    {
        $field = new HiddenField();
        $this->assertSame('hidden', $field->getType());
    }

    public function testRender()
    {
        $field = new HiddenField();
        $this->assertInstanceOf(RenderableInterface::class, $field);
        $this->assertSame('<input type="hidden">', $field->render());

        $field = new HiddenField('foo');
        $this->assertSame('<input type="hidden" name="foo">', $field->render());

        $field = new HiddenField('foo', 42);
        $this->assertSame('<input type="hidden" name="foo" value="42">', $field->render());

        $field = new HiddenField('foo', 42, ['class'=>'test']);
        $this->assertSame('<input type="hidden" class="test" name="foo" value="42">', $field->render());
    }

}
