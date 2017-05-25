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

    public function testGetFullName()
    {
        $el = new class implements ElementInterface { use \Runn\Html\Form\ElementTrait; };
        // @todo: assertNull() in 7.1
        $this->assertEmpty($el->getFullName());

        $el->setName('foo');
        $this->assertSame('foo', $el->getFullName());
    }

}