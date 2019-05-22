<?php

namespace Runn\tests\Html\Form\ElementsGroup;

use Runn\Html\Form\Buttons\SubmitButton;
use Runn\Html\Form\ElementsGroup;
use Runn\Html\Form\Fields\NumberField;
use Runn\Html\Form\Fields\PasswordField;
use Runn\Html\Form\Fields\TextField;
use Runn\Html\HasValueInterface;
use Runn\ValueObjects\ComplexValueObject;
use Runn\ValueObjects\Values\IntValue;
use Runn\ValueObjects\Values\StringValue;

class testElementsGroup extends ElementsGroup {}

class testValueObject extends ComplexValueObject {
    protected static $schema = [
        'el1' => ['class' => StringValue::class],
        'el2' => ['class' => IntValue::class],
    ];
}

class ElementsGroupTest extends \PHPUnit_Framework_TestCase
{

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

    public function testSetParentForElements()
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

    public function testGetValueWithClass()
    {
        $el1 = new TextField('foo', 'value1');
        $el2 = new NumberField('bar', 42);
        $group = new testElementsGroup(['el1' => $el1, 'el2' => $el2]);

        $this->assertSame(['el1' => 'value1', 'el2' => 42], $group->getValue());
        $this->assertInstanceOf(testValueObject::class, $group->getValue(testValueObject::class));
        $this->assertEquals(new testValueObject(['el1' => 'value1', 'el2' => 42]), $group->getValue(testValueObject::class));
    }

    public function testMagicGetSet()
    {
        $elements = new testElementsGroup();

        $test = new NumberField('schema');

        $elements->schema = $test;
        $this->assertSame($test, $elements->schema);
        $this->assertEmpty($elements->getSchema());

        $test = new NumberField('parent');

        $elements->parent = $test;
        $this->assertSame($test, $elements->parent);
        $this->assertNull($elements->getParent());
        $this->assertTrue($elements->getParents()->empty());

        $test = new NumberField('name');

        $elements->name = $test;
        $this->assertSame($test, $elements->name);
        $this->assertNull($elements->getName());

        $test = new NumberField('renderer');

        $elements->renderer = $test;
        $this->assertSame($test, $elements->renderer);
        $this->assertNotSame($elements->renderer, $elements->getRenderer());

        $test = new NumberField('form');

        $elements->form = $test;
        $this->assertSame($test, $elements->form);
        $this->assertNotSame($elements->form, $elements->getForm());

        $test = new NumberField('template');

        $elements->template = $test;
        $this->assertSame($test, $elements->template);
        $this->assertNotSame($elements->template, $elements->getTemplate());

        $test = new NumberField('defaultTemplate');

        $elements->defaultTemplate = $test;
        $this->assertSame($test, $elements->defaultTemplate);
        $this->assertNotSame($elements->defaultTemplate, $elements->getDefaultTemplate());

        $test = new NumberField('name');

        $elements->name = $test;
        $this->assertSame($test, $elements->name);
        $this->assertNotSame($elements->name, $elements->getName());

        $test = new NumberField('fullName');

        $elements->fullName = $test;
        $this->assertSame($test, $elements->fullName);
        $this->assertNotSame($elements->fullName, $elements->getFullName());

        $test = new NumberField('value');

        $elements->value = $test;
        $this->assertSame($test, $elements->value);
        $this->assertNotSame($elements->value, $elements->getValue());

        $test = new NumberField('validator');

        $elements->validator = $test;
        $this->assertSame($test, $elements->validator);

    }

    public function testMagisSetValue()
    {
        $fields = ['__data', 'name', 'parent', 'form', 'renderer', 'template', 'value', 'validator', 'errors'];
        $data = array_combine($fields, array_fill(0, count($fields), rand(1, 10)));

        $group = new testElementsGroup();
        foreach ($fields as $field) {
            $group->$field = new NumberField();
        }
        $group->setValue($data);

        $this->assertSame($data, $group->getValue());
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

        $submit = new SubmitButton('Click me!');
        $group->submit = $submit;

        $this->assertSame(['foo' => 'baz'], $group->getValue());
    }

}
