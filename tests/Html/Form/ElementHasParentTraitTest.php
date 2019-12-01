<?php

namespace Runn\tests\Html\Form\HasParentTrait;

use PHPUnit\Framework\TestCase;
use Runn\Html\Form\ElementHasParentInterface;
use Runn\Html\Form\ElementHasParentTrait;
use Runn\Html\Form\ElementsCollection;
use Runn\Html\Form\FormElementInterface;
use Runn\Html\Form\FormElementTrait;

class HasParentTraitTest extends TestCase
{

    public function testSetGetParent()
    {
        $element = new class implements ElementHasParentInterface {
            use ElementHasParentTrait;
        };

        $this->assertFalse($element->hasParent());
        $this->assertNull($element->getParent());
        $this->assertEquals(new ElementsCollection(), $element->getParents());
        $this->assertTrue($element->getParents()->empty());

        $parent = new class implements FormElementInterface {
            use FormElementTrait;
        };

        $res = $element->setParent($parent);
        $this->assertSame($element, $res);
        $this->assertTrue($element->hasParent());
        $this->assertSame($parent, $element->getParent());
        $this->assertEquals(new ElementsCollection([$parent]), $element->getParents());
    }

    public function testGetParentsChain()
    {
        $element11 = new class implements ElementHasParentInterface {
            use ElementHasParentTrait;
        };

        $element1 =new class implements FormElementInterface {
            use FormElementTrait;
        };

        $super = new class implements FormElementInterface {
            use FormElementTrait;
        };

        $element1->setParent($super);
        $element11->setParent($element1);

        $this->assertEquals(new ElementsCollection([$super, $element1]), $element11->getParents());
    }

}
