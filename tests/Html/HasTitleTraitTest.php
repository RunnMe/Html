<?php

namespace Runn\tests\Html\HasTitleTrait;

use Runn\Html\HasTitleInterface;
use Runn\Html\HasTitleTrait;
use PHPUnit\Framework\TestCase;

class HasTitleTraitTest extends TestCase
{

    public function testSetGetTitle()
    {
        $element = new class implements HasTitleInterface {
            use HasTitleTrait;
        };

        $this->assertNull($element->getTitle());

        $res = $element->setTitle(42);
        $this->assertSame($element, $res);
        $this->assertSame('42', $element->getTitle());

        $res = $element->setTitle('foo');
        $this->assertSame($element, $res);
        $this->assertSame('foo', $element->getTitle());

        $res = $element->setTitle(null);
        $this->assertSame($element, $res);
        $this->assertNull($element->getTitle());
    }

}
