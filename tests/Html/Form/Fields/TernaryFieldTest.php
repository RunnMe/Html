<?php

namespace Runn\tests\Html\Form\Fields\TernaryField;

use PHPUnit\Framework\TestCase;
use Runn\Html\Form\Fields\TernaryField;
use Runn\Html\Rendering\RenderableInterface;

class TernaryFieldTest extends TestCase
{

    public function testGetType()
    {
        $field = new TernaryField();
        $this->assertSame('checkbox', $field->getType());
    }

    public function testSetGetValue()
    {
        $field = new TernaryField();
        $this->assertNull($field->getValue());

        $field->setValue(true);
        $this->assertSame(1, $field->getValue());

        $field->setValue(1);
        $this->assertSame(1, $field->getValue());

        $field->setValue(false);
        $this->assertSame(0, $field->getValue());

        $field->setValue(0);
        $this->assertSame(0, $field->getValue());

        $field->setValue(null);
        $this->assertSame(null, $field->getValue());

        $field->setValue('');
        $this->assertSame(null, $field->getValue());
    }

    /**
     * @todo
     */
    public function testRender()
    {
        $onclick = ' onclick="if(this.readOnly){this.checked=this.readOnly=false;this.previousSibling.value=\'0\';this.value=1;}else if(!this.checked){this.readOnly=this.indeterminate=true;this.previousSibling.value=\'\';this.value=\'\';}"';
        $img = '<img src onerror="this.previousSibling.readOnly=this.previousSibling.indeterminate=true;">';

        $field = new TernaryField();
        $this->assertInstanceOf(RenderableInterface::class, $field);
        $this->assertSame('<input type="hidden" value=""><input type="checkbox" value=""' . $onclick . '>' . $img, $field->render());

        $field = new TernaryField('foo');
        $this->assertSame('<input type="hidden" name="foo" value=""><input type="checkbox" name="foo" value=""' . $onclick . '>' . $img, $field->render());

        $field = new TernaryField('foo', null);
        $this->assertSame('<input type="hidden" name="foo" value=""><input type="checkbox" name="foo" value=""' . $onclick . '>' . $img, $field->render());

        $field = new TernaryField('foo', false);
        $this->assertSame('<input type="hidden" name="foo" value="0"><input type="checkbox" name="foo" value="1"' . $onclick . '>', $field->render());

        $field = new TernaryField('foo', 0);
        $this->assertSame('<input type="hidden" name="foo" value="0"><input type="checkbox" name="foo" value="1"' . $onclick . '>', $field->render());

        $field = new TernaryField('foo', true);
        $this->assertSame('<input type="hidden" name="foo" value="0"><input type="checkbox" name="foo" checked value="1"' . $onclick . '>', $field->render());

        $field = new TernaryField('foo', 1);
        $this->assertSame('<input type="hidden" name="foo" value="0"><input type="checkbox" name="foo" checked value="1"' . $onclick . '>', $field->render());

        $field = new TernaryField('foo', 1, ['class'=>'test']);
        $this->assertSame('<input type="hidden" name="foo" value="0"><input type="checkbox" class="test" name="foo" checked value="1"' . $onclick . '>', $field->render());
    }

}
