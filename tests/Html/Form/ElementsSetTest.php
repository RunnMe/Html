<?php

namespace Runn\tests\Html\Form\ElementsSet;

use Runn\Html\Form\ElementsSet;
use Runn\Html\Form\Fields\TextField;
use Runn\Html\HasValueInterface;
use Runn\Html\RenderableInterface;

class ExtendedTextField extends TextField {}

class testElementsSet extends ElementsSet {
    protected static $elementsType = TextField::class;
}

class testElementsSetInvalidBaseClass extends ElementsSet {
    protected static $elementsType = \stdClass::class;
}

class testElementsSetFixedName extends ElementsSet {
    protected static $elementsType = TextField::class;
    protected static $elementsName = 'fixed';
}

class ElementsSetTest extends \PHPUnit_Framework_TestCase
{

    public function testGetType()
    {
        $prop = new \ReflectionProperty(testElementsSet::class, 'elementsType');
        $prop->setAccessible(true);

        $set = new testElementsSet;

        $this->assertSame($prop->getValue(), $set->getElementsType());
        $this->assertSame($prop->getValue(), testElementsSet::getElementsType());
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
     * @expectedExceptionMessage Invalid class for element "1"
     */
    public function testInvalidElementClass1()
    {
        $set = new testElementsSet;
        $set[1] = 42;
    }

    /**
     * @expectedException \Runn\Html\Form\Exception
     * @expectedExceptionMessage Invalid class for element "1"
     */
    public function testInvalidElementClass2()
    {
        $set = new testElementsSet;
        $set[1] = new \stdClass();
    }

    /**
     * @expectedException \Runn\Html\Form\Exception
     * @expectedExceptionMessage Invalid class for element "1"
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
    }

    public function testRender()
    {
        $set = new testElementsSetFixedName();
        $set[] = new TextField('foo', 42);
        $set[] = new TextField('bar', 24);

        $this->assertInstanceOf(RenderableInterface::class, $set);
        $this->assertSame("Test template|foo=42||bar=24|", $set->render());
    }

}