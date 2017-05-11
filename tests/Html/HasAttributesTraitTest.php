<?php

namespace Runn\tests\Html\HasAttributesTrait;

use Runn\Core\Std;
use Runn\Html\HasAttributesInterface;
use Runn\Html\HasAttributesTrait;

class HasAttributesTraitTest extends \PHPUnit_Framework_TestCase
{

    public function testAttributes()
    {
        $element = new class implements HasAttributesInterface {
            use HasAttributesTrait;
        };

        $this->assertNull($element->getAttributes());

        $ret = $element->setAttribute('attr1', 'val1');

        $this->assertSame($element, $ret);
        $this->assertCount(1, $element->getAttributes());
        $this->assertSame('val1',  $element->getAttributes()->attr1);
        $this->assertSame('val1',  $element->getAttribute('attr1'));

        $element->attributes(['attr1' => 1, 'attr2' => 2]);

        $this->assertCount(2, $element->getAttributes());
        $this->assertSame('1',  $element->getAttributes()->attr1);
        $this->assertSame('1',  $element->getAttribute('attr1'));
        $this->assertSame('2',  $element->getAttributes()->attr2);
        $this->assertSame('2',  $element->getAttribute('attr2'));

        $element->attributes(new Std(['attr11' => 11, 'attr22' => '22']));

        $this->assertCount(2, $element->getAttributes());
        $this->assertSame('11',    $element->getAttributes()->attr11);
        $this->assertSame('11',    $element->getAttribute('attr11'));
        $this->assertSame('22',  $element->getAttributes()->attr22);
        $this->assertSame('22',  $element->getAttribute('attr22'));
    }

}