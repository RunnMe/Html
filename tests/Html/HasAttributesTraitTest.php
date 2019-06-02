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
        $this->assertNull($element->getAttribute('attr1'));
        $this->assertNull($element->getAttribute('attr2'));
        $this->assertFalse($element->issetAttribute('attr1'));
        $this->assertFalse($element->issetAttribute('attr2'));

        $ret = $element->setAttribute('attr1', null);

        $this->assertSame($element, $ret);
        $this->assertCount(1, $element->getAttributes());
        $this->assertSame(null, $element->getAttributes()->attr1);
        $this->assertSame(null, $element->getAttribute('attr1'));
        $this->assertTrue($element->issetAttribute('attr1'));
        $this->assertFalse($element->issetAttribute('attr2'));

        $ret = $element->setAttribute('attr1', 'val1');

        $this->assertSame($element, $ret);
        $this->assertCount(1, $element->getAttributes());
        $this->assertSame('val1', $element->getAttributes()->attr1);
        $this->assertSame('val1', $element->getAttribute('attr1'));
        $this->assertTrue($element->issetAttribute('attr1'));
        $this->assertFalse($element->issetAttribute('attr2'));

        $element->setAttributes(['attr1' => 1, 'attr2' => 2]);

        $this->assertCount(2, $element->getAttributes());
        $this->assertSame('1', $element->getAttributes()->attr1);
        $this->assertSame('1', $element->getAttribute('attr1'));
        $this->assertSame('2', $element->getAttributes()->attr2);
        $this->assertSame('2', $element->getAttribute('attr2'));
        $this->assertTrue($element->issetAttribute('attr1'));
        $this->assertTrue($element->issetAttribute('attr2'));

        $element->setAttributes(new Std(['attr11' => 11, 'attr22' => '22']));

        $this->assertCount(2, $element->getAttributes());
        $this->assertSame('11',  $element->getAttributes()->attr11);
        $this->assertSame('11',  $element->getAttribute('attr11'));
        $this->assertSame('22',  $element->getAttributes()->attr22);
        $this->assertSame('22',  $element->getAttribute('attr22'));
        $this->assertTrue($element->issetAttribute('attr11'));
        $this->assertTrue($element->issetAttribute('attr22'));

        $element->unsetAttribute('attr11');
        $this->assertCount(1, $element->getAttributes());
        $this->assertFalse($element->issetAttribute('attr11'));
        $this->assertTrue($element->issetAttribute('attr22'));

        $element->setAttributes(null);
        $this->assertNull($element->getAttributes());
        $this->assertFalse($element->issetAttribute('attr11'));
        $this->assertFalse($element->issetAttribute('attr22'));
    }

}
