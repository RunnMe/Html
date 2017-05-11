<?php

namespace Runn\tests\Html\HasNameTrait;

use Runn\Html\HasNameInterface;
use Runn\Html\HasNameTrait;

class HasNameTraitTest extends \PHPUnit_Framework_TestCase
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
    }

}