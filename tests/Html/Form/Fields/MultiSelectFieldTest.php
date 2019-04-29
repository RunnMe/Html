<?php

namespace Runn\tests\Html\Form\Fields\MultiSelectField;

use Runn\Core\Std;
use Runn\Html\Form\Fields\MultiSelectField;
use Runn\Html\Rendering\RenderableInterface;
use PHPUnit\Framework\TestCase;

class MultiSelectFieldTest extends TestCase
{

    public function testRenderWoOptions()
    {
        $field = new MultiSelectField();
        $this->assertInstanceOf(RenderableInterface::class, $field);
        $this->assertSame('<select multiple></select>', $field->render());

        $field = new MultiSelectField('foo');
        $this->assertSame('<select name="foo[]" multiple></select>', $field->render());

        $field = new MultiSelectField('foo', 42);
        $this->assertSame('<select name="foo[]" multiple></select>', $field->render());

        $field = new MultiSelectField('foo', 42, ['class'=>'test']);
        $this->assertSame('<select class="test" name="foo[]" multiple></select>', $field->render());
    }

    public function testRenderWOptions()
    {
        $field = (new MultiSelectField())->values([1 => 'foo', 2 => 'bar']);
        $this->assertSame("<select multiple>\n<option value=\"1\">foo</option>\n<option value=\"2\">bar</option>\n</select>", $field->render());

        $field = (new MultiSelectField())->values(new Std([1 => 'foo', 2 => 'bar']));
        $this->assertSame("<select multiple>\n<option value=\"1\">foo</option>\n<option value=\"2\">bar</option>\n</select>", $field->render());

        $field = (new MultiSelectField('test', 'bar'))->values([1 => 'foo', 2 => 'bar']);
        $this->assertSame("<select name=\"test[]\" multiple>\n<option value=\"1\">foo</option>\n<option value=\"2\" selected>bar</option>\n</select>", $field->render());

        $field = (new MultiSelectField('test', ['foo','bar']))->values([1 => 'foo', 2 => 'bar', 3=>'baz']);
        $this->assertSame("<select name=\"test[]\" multiple>\n<option value=\"1\" selected>foo</option>\n<option value=\"2\" selected>bar</option>\n<option value=\"3\">baz</option>\n</select>", $field->render());
    }

}
