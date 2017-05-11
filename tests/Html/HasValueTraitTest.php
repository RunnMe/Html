<?php

namespace Runn\tests\Html\HasValueTrait;

use Runn\Html\HasValueInterface;
use Runn\Html\HasValueTrait;

class HasValueTraitTest extends \PHPUnit_Framework_TestCase
{

    public function testSetGetValue()
    {
        $element = new class implements HasValueInterface {
            use HasValueTrait;
        };

        $res = $element->setValue(42);
        $this->assertSame($element, $res);
        $this->assertSame(42, $element->getValue());
    }

}