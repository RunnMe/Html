<?php

namespace Runn\tests\Html\Form\ElementTrait;

use Runn\Html\Form;
use Runn\Html\Form\ElementsCollection;
use Runn\Html\Form\ElementsGroup;
use Runn\Html\Form\ElementsSet;
use Runn\Html\Form\Fields\InputField;
use Runn\Html\Form\ElementInterface;
use Runn\Html\Form\ElementTrait;

class ElementTraitTest extends \PHPUnit_Framework_TestCase
{

    public function testGetForm()
    {
        $form = new Form;

        $grand = new class extends ElementsGroup {};

        $this->assertFalse($grand->belongsToForm());
        $this->assertNull($grand->getForm());
        $this->assertEquals(new ElementsCollection([]), $grand->getParents());

        $grand->setParent($form);

        $this->assertTrue($grand->belongsToForm());
        $this->assertSame($form, $grand->getForm());
        $this->assertEquals(new ElementsCollection([$form]), $grand->getParents());

        $parent = new class extends ElementsSet {};

        $this->assertFalse($parent->belongsToForm());
        $this->assertNull($parent->getForm());
        $this->assertEquals(new ElementsCollection([]), $parent->getParents());

        $parent->setParent($grand);

        $this->assertTrue($parent->belongsToForm());
        $this->assertSame($form, $parent->getForm());
        $this->assertEquals(new ElementsCollection([$form, $grand]), $parent->getParents());

        $element = new InputField;

        $this->assertFalse($element->belongsToForm());
        $this->assertNull($element->getForm());
        $this->assertEquals(new ElementsCollection([]), $element->getParents());

        $element->setParent($parent);

        $this->assertTrue($element->belongsToForm());
        $this->assertSame($form, $element->getForm());
        $this->assertEquals(new ElementsCollection([$form, $grand, $parent]), $element->getParents());

        $form = new Form;
        $element->setParent($parent);
        $form->foo = $element;

        $this->assertTrue($element->belongsToForm());
        $this->assertSame($form, $element->getForm());
        $this->assertEquals(new ElementsCollection([$form]), $element->getParents());
    }

    public function testGetNameHashParents()
    {
        $first = new class extends ElementsGroup {};

        $this->assertNull($first->getNameHash());

        $first->setName('first');

        $parent = new class extends ElementsSet {protected static $elementsType = InputField::class;};
        $parent->setName('set');
        $first->element = $parent;

        $element = new InputField('foo');
        $parent[] = $element;

        $this->assertSame(sha1('first+set+foo'), $element->getNameHash());
    }

    public function testGetNameHashNullParentName()
    {
        $parent = new class implements ElementInterface {
            use ElementTrait;
        };
        $element = new InputField('foo');
        $element->setParent($parent);

        $this->assertSame(sha1('+foo'), $element->getNameHash());
    }

}