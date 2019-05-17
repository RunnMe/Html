<?php

namespace Runn\tests\Html\HasValueTrait;

use Runn\Html\HasValueInterface;
use Runn\Html\HasValueTrait;
use Runn\ValueObjects\Values\IntValue;

class HasValueTraitTest extends \PHPUnit_Framework_TestCase
{

    public function testSetGetValue()
    {
        $element = new class implements HasValueInterface {
            use HasValueTrait;
        };

        $this->assertNull($element->getValue());

        $res = $element->setValue(42);
        $this->assertSame($element, $res);
        $this->assertSame(42, $element->getValue());

        $res = $element->setValue(null);
        $this->assertSame($element, $res);
        $this->assertNull($element->getValue());
    }

    public function testGetValueWithClass()
    {
        $element = new class implements HasValueInterface {
            use HasValueTrait;
        };
        $element->setValue(42);

        $this->assertSame(42, $element->getValue());
        $this->assertInstanceOf(IntValue::class, $element->getValue(IntValue::class));
        $this->assertEquals(new IntValue(42), $element->getValue(IntValue::class));
    }

}