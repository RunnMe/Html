<?php

namespace Runn\tests\Html\HasNameTrait;

use PHPUnit\Framework\TestCase;
use Runn\Html\Form\ElementHasParentInterface;
use Runn\Html\Form\ElementHasParentTrait;
use Runn\Html\Form\ElementsCollection;
use Runn\Html\Form\ElementsGroup;
use Runn\Html\Form\ElementsSet;
use Runn\Html\Form\Fields\TextField;
use Runn\Html\Form\Form;
use Runn\Html\Form\FormElementInterface;
use Runn\Html\Form\FormElementTrait;
use Runn\Html\HasNameInterface;
use Runn\Html\HasNameTrait;

class testGroup extends ElementsGroup {};

class HasNameTraitTest extends TestCase
{

    public function testSetGetName()
    {
        $element = new class implements HasNameInterface {
            use HasNameTrait;
        };

        $this->assertNull($element->getName());

        $res = $element->setName(42);
        $this->assertSame($element, $res);
        $this->assertSame('42', $element->getName());

        $res = $element->setName('foo');
        $this->assertSame($element, $res);
        $this->assertSame('foo', $element->getName());

        $res = $element->setName(null);
        $this->assertSame($element, $res);
        $this->assertNull($element->getName());
    }

    public function testElementFullNameHasNoParentElement()
    {
        $element = new class implements HasNameInterface { use HasNameTrait; };

        $this->assertNull($element->getName());
        $this->assertNull($element->getFullName());

        $element->setName('foo');

        $this->assertSame('foo', $element->getName());
        $this->assertSame('foo', $element->getFullName());

        $element = new class implements HasNameInterface, ElementHasParentInterface { use HasNameTrait, ElementHasParentTrait; };

        $this->assertTrue($element->getParents()->empty());

        $this->assertNull($element->getName());
        $this->assertNull($element->getFullName());

        $element->setName('foo');

        $this->assertSame('foo', $element->getName());
        $this->assertSame('foo', $element->getFullName());
    }

    public function testElementFullNameHasParentGroup()
    {
        $element = new class implements FormElementInterface, HasNameInterface { use FormElementTrait, HasNameTrait; };
        $group = new class extends ElementsGroup {};

        $group->element1 = $element;

        $this->assertSame($group, $element->getParent());
        $this->assertEquals(new ElementsCollection([$group]), $element->getParents());

        $this->assertNull($element->getName());
        $this->assertNull($element->getFullName());

        $element->setName('foo');
        $this->assertSame('foo', $element->getName());
        $this->assertSame('foo', $element->getFullName());

        $group->setName('bar');
        $this->assertSame('foo', $element->getName());
        $this->assertSame('bar[element1]', $element->getFullName());
    }

    public function testElementFullNameHasParentSet()
    {
        $set = new class extends ElementsSet {
            public static function getType() {
                return TextField::class;
            }
        };
        $element = new TextField;
        $set[1] = $element;

        $this->assertSame($set, $element->getParent());
        $this->assertEquals(new ElementsCollection([$set]), $element->getParents());

        $this->assertNull($element->getName());
        $this->assertNull($element->getFullName());

        $element->setName('foo');
        $this->assertSame('foo', $element->getName());
        $this->assertSame('foo', $element->getFullName());

        $set->setName('bar');
        $this->assertSame('foo', $element->getName());
        $this->assertSame('bar[1]', $element->getFullName());
    }

    public function testElementFullNameHasParents()
    {
        $element = new TextField;

        $innerGroup = new testGroup;
        $innerGroup->element = $element;

        $set = new class extends ElementsSet { public static function getType() {return testGroup::class;} };
        $set[1] = $innerGroup;

        $outerGroup = new class extends ElementsGroup {};
        $outerGroup->set = $set;

        $form = new Form();
        $form->group = $outerGroup;

        $this->assertEquals(new ElementsCollection([$form, $outerGroup, $set, $innerGroup]), $element->getParents());
        $this->assertNull($element->getFullName());

        $element->setName('foo');
        $this->assertSame('foo', $element->getFullName());

        $innerGroup->setName('bar');
        $this->assertSame('bar[element]', $element->getFullName());

        $set->setName('baz');
        $this->assertSame('baz[1][element]', $element->getFullName());

        $outerGroup->setName('bla');
        $this->assertSame('bla[set][1][element]', $element->getFullName());

        $form->setName('myform');
        $this->assertSame('myform[group][set][1][element]', $element->getFullName());
    }

}
