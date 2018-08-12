<?php

namespace Runn\tests\Html\Form\ElementsSet;

use Runn\Core\TypedCollection;
use Runn\Html\Form\ElementsCollection;
use Runn\Html\Form\ElementsSet;
use Runn\Html\Form\Fields\TextField;
use Runn\Html\Form\FormElementInterface;
use Runn\Html\HasNameInterface;
use Runn\Html\HasValueInterface;

class ExtendedTextField extends TextField {}

class testElementsSet extends ElementsSet {
    public static function getType() {
        return TextField::class;
    }
}

class testElementsSetInvalidBaseClass extends ElementsSet {
    public static function getType() {
        return \stdClass::class;
    }
}

class testElementsSetFixedName extends ElementsSet {
    public static function getType() {
        return TextField::class;
    }
}

class ElementsSetTest extends \PHPUnit_Framework_TestCase
{

    public function testInstances()
    {
        $set = new class extends ElementsSet {};

        $this->assertInstanceOf(ElementsSet::class, $set);
        $this->assertInstanceOf(TypedCollection::class, $set);
        $this->assertInstanceOf(ElementsCollection::class, $set);
        $this->assertInstanceOf(FormElementInterface::class, $set);
        $this->assertInstanceOf(HasNameInterface::class, $set);
        $this->assertInstanceOf(HasValueInterface::class, $set);

        $this->assertSame(FormElementInterface::class, ElementsSet::getType());
    }

    /**
     * @expectedException \Runn\Html\Form\Exception
     * @expectedExceptionMessage Invalid ElementsSet base class "stdClass"
     */
    public function testInvalidBaseClass()
    {
        $set = new testElementsSetInvalidBaseClass;
        $set[] = new \stdClass();
    }

    /**
     * @expectedException \Runn\Html\Form\Exception
     * @expectedExceptionMessage Elements set type mismatch
     */
    public function testInvalidElementClass1()
    {
        $set = new testElementsSet;
        $set[1] = 42;
    }

    /**
     * @expectedException \Runn\Html\Form\Exception
     * @expectedExceptionMessage Elements set type mismatch
     */
    public function testInvalidElementClass2()
    {
        $set = new testElementsSet;
        $set[1] = new \stdClass();
    }

    /**
     * @expectedException \Runn\Html\Form\Exception
     * @expectedExceptionMessage Elements set type mismatch
     */
    public function testInvalidElementClass3()
    {
        $set = new testElementsSet;
        $set[1] = new ExtendedTextField();
    }

    /**
     * @expectedException \Runn\Html\Form\Exception
     * @expectedExceptionMessage Invalid ElementsSet (Runn\tests\Html\Form\ElementsSet\testElementsSet) key: "foo"
     */
    public function testInvalidKey()
    {
        $set = new testElementsSet;
        $set['foo'] = new TextField();
    }

    public function testInnerSet()
    {
        $set = new testElementsSet;
        $field = new TextField;
        $set[1] = $field;

        $this->assertCount(1, $set);
        $this->assertSame($field, $set[1]);

        $this->assertSame($set, $field->getParent());
    }

    public function testHasValueInterface()
    {
        $set = new testElementsSet;

        $this->assertInstanceOf(HasValueInterface::class, $set);
        $this->assertSame([], $set->getValue());

        $set[] = new TextField('foo', 'value1');
        $set[] = new TextField('bar', 'value2');

        $this->assertSame([0 => 'value1', 1 => 'value2'], $set->getValue());

        $set->setValue([0 => 'foo', 1 => 'bar']);

        $this->assertSame([0 => 'foo', 1 => 'bar'], $set->getValue());
        $this->assertSame('foo', $set[0]->getValue());
        $this->assertSame('bar', $set[1]->getValue());
    }

}
