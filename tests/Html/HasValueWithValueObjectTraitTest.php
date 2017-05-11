<?php

namespace Runn\tests\Html\HasValueWithValueObjectTrait;

use Runn\Html\HasValueWithValueObjectInterface;
use Runn\Html\HasValueWithValueObjectTrait;
use Runn\ValueObjects\IntValue;
use Runn\ValueObjects\StringValue;

class HasValueWithValueObjectTraitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Runn\ValueObjects\Exception
     * @expectedExceptionMessage Invalid value object class: "Runn\ValueObjects\StringValue"
     */
    public function testInvalidValueObjectClass()
    {

        $element = new class implements HasValueWithValueObjectInterface {
            use HasValueWithValueObjectTrait;
            public static function getValueObjectClass(): string
            {
                return IntValue::class;
            }
        };

        $res = $element->setValue(new StringValue('42'));
    }

    public function testSetGetValue()
    {
        $element = new class implements HasValueWithValueObjectInterface {
            use HasValueWithValueObjectTrait;
            public static function getValueObjectClass(): string
            {
                return IntValue::class;
            }
        };

        $res = $element->setValue(42);

        $this->assertSame($element, $res);
        $this->assertSame(42, $element->getValue());
        $this->assertEquals(new IntValue(42), $element->getValueObject());

        $res = $element->setValue(new IntValue(24));

        $this->assertSame($element, $res);
        $this->assertSame(24, $element->getValue());
        $this->assertEquals(new IntValue(24), $element->getValueObject());
    }

}