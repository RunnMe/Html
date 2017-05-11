<?php

namespace Runn\tests\Html\Form\ElementsGroup;

use Runn\Html\Form\ElementsGroup;
use Runn\Html\Form\Fields\NumberField;
use Runn\Html\Form\Fields\TextField;
use Runn\ValueObjects\ComplexValueObject;
use Runn\ValueObjects\IntValue;
use Runn\ValueObjects\StringValue;

class testElementsGroupValueObject extends ComplexValueObject {
    protected static $schema = [
        'foo' => [
            'class' => StringValue::class,
        ],
        'bar' => [
            'class' => IntValue::class,
        ],
    ];
}

class testElementsGroupWithValueObject extends ElementsGroup {
    protected static $schema = [
        'foo' => [
            'class' => TextField::class,
        ],
        'bar' => [
            'class' => NumberField::class,
        ],
    ];
    public static function getValueObjectClass(): string
    {
        return testElementsGroupValueObject::class;
    }
}

class ElementsGroupValueObjectTest extends \PHPUnit_Framework_TestCase
{

    public function testGetValueObject()
    {
        $group = new testElementsGroupWithValueObject;
        $group->foo->setValue('blabla');
        $group->bar->setValue(42);

        $this->assertInstanceOf(testElementsGroupValueObject::class, $group->getValueObject());

        $this->assertInstanceOf(StringValue::class, $group->getValueObject()->foo);
        $this->assertSame('blabla', $group->getValueObject()->foo->getValue());

        $this->assertInstanceOf(IntValue::class, $group->getValueObject()->bar);
        $this->assertSame(42, $group->getValueObject()->bar->getValue());
    }

}