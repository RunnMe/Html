<?php

namespace Runn\tests\Html\Form\ElementsGroup;

use Runn\Fs\File;
use Runn\Html\Form\ElementsGroup;
use Runn\Html\Form\Fields\NumberField;
use Runn\Html\Form\Fields\PasswordField;
use Runn\Html\Form\Fields\TextField;
use Runn\Html\HasValueInterface;
use Runn\Html\RenderableInterface;

class testElementsGroup extends ElementsGroup {}

class ElementsGroupTest extends \PHPUnit_Framework_TestCase
{

    public function testGetTemplatePath()
    {
        $method = new \ReflectionMethod(testElementsGroup::class, 'getTemplate');
        $method->setAccessible(true);

        $elements = new testElementsGroup();

        $this->assertEquals(new File(__DIR__ . '/ElementsGroupTest.template.html'), $method->invoke($elements));
    }

    /**
     * @expectedException \Runn\Html\Form\Exception
     * @expectedExceptionMessage Invalid ElementsGroup (Runn\tests\Html\Form\ElementsGroup\testElementsGroup) key:
     */
    public function testInvalidKeyEmpty()
    {
        $elements = new testElementsGroup([new TextField()]);
    }

    /**
     * @expectedException \Runn\Html\Form\Exception
     * @expectedExceptionMessage Invalid ElementsGroup (Runn\tests\Html\Form\ElementsGroup\testElementsGroup) key: 1
     */
    public function testInvalidKeyNumeric()
    {
        $elements = new testElementsGroup([1 => new TextField()]);
    }

    /**
     * @expectedException \Runn\Html\Form\Exception
     * @expectedExceptionMessage Invalid ElementsGroup (Runn\tests\Html\Form\ElementsGroup\testElementsGroup) value by key: foo
     */
    public function testInvalidValue()
    {
        $elements = new testElementsGroup(['foo' => new \stdClass()]);
    }

    public function testParent()
    {
        $el1 = new TextField('foo');
        $el2 = new PasswordField('bar');

        $group = new testElementsGroup(['f' => $el1]);
        $this->assertSame($group, $el1->getParent());

        $group->b = $el2;
        $this->assertSame($group, $el2->getParent());
    }

    public function testHasValueInterface()
    {
        $group = new testElementsGroup();
        $this->assertInstanceOf(HasValueInterface::class, $group);
        $this->assertSame([], $group->getValue());

        $el1 = new TextField('foo', 'value1');
        $el2 = new PasswordField('bar', 'value2');
        $group = new testElementsGroup(['el1' => $el1, 'el2' => $el2]);

        $this->assertInstanceOf(HasValueInterface::class, $group);
        $this->assertSame(['el1' => 'value1', 'el2' => 'value2'], $group->getValue());
    }

    public function testRender()
    {
        $elements = new testElementsGroup();
        $this->assertInstanceOf(RenderableInterface::class, $elements);

        $this->assertSame("Test template", $elements->render());

        $elements = new testElementsGroup(['f'=>new TextField('foo'), 'b'=>new PasswordField('bar')]);

        $this->assertSame("Test templatef:foob:bar", $elements->render());
    }

    public function testMagicGetSet()
    {
        $elements = new testElementsGroup();

        $test = new NumberField('parent');
        $elements->parent = $test;
        $this->assertSame($test, $elements->parent);
        $this->assertNull($elements->getParent());

        $test = new NumberField('name');
        $elements->name = $test;
        $this->assertSame($test, $elements->name);
        $this->assertNull($elements->getName());

        $test = new NumberField('title');
        $elements->title = $test;
        $this->assertSame($test, $elements->title);
        $this->assertNull($elements->getTitle());

        $test = new NumberField('value');
        $elements->value = $test;
        $this->assertSame($test, $elements->value);
        $this->assertNotEquals($test, $elements->getValue());

        $test = new NumberField('option');
        $elements->option = $test;
        $this->assertSame($test, $elements->option);


        $test = new NumberField('form');
        $elements->form = $test;
        $this->assertSame($test, $elements->form);
        $this->assertNull($elements->getForm());
    }

    public function testSetValue()
    {
        $group = new testElementsGroup();

        $group->setValue([]);
        $this->assertEmpty($group->getValue());

        $group->setValue(['foo' => 'bar']);
        $this->assertEmpty($group->getValue());

        $element1 = new TextField();
        $group->foo = $element1;

        $group->setValue([]);
        $this->assertSame(['foo' => null], $group->getValue());

        $group->setValue(['foo' => 'bar']);
        $this->assertSame(['foo' => 'bar'], $group->getValue());

        $group->setValue(['foo' => 'baz', 'bla' => 42]);
        $this->assertSame(['foo' => 'baz'], $group->getValue());
    }
}
