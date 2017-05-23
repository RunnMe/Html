<?php

namespace Runn\tests\Html\Form\HasParentTrait;

use Runn\Core\Collection;
use Runn\Core\Std;
use Runn\Html\Form\ElementHasParentInterface;
use Runn\Html\Form\ElementInterface;
use Runn\Html\Form\ElementsCollection;
use Runn\Html\Form\ElementTrait;

class HasParentTraitTest extends \PHPUnit_Framework_TestCase
{

    public function testSetGetParent()
    {
        $element = new class implements ElementHasParentInterface {
            use \Runn\Html\Form\ElementHasParentTrait;
        };

        $this->assertNull($element->getParent());
        $this->assertEquals(new ElementsCollection(), $element->getParents());
        $this->assertTrue($element->getParents()->empty());

        $parent = new class implements ElementInterface {
            use ElementTrait;
        };

        $res = $element->setParent($parent);
        $this->assertSame($element, $res);
        $this->assertSame($parent, $element->getParent());
        $this->assertEquals(new ElementsCollection([$parent]), $element->getParents());
    }

    public function testGetParentsChain()
    {
        $element11 = new class implements ElementHasParentInterface {
            use \Runn\Html\Form\ElementHasParentTrait;
        };

        $element1 =new class implements ElementInterface {
            use ElementTrait;
        };

        $super = new class implements ElementInterface {
            use ElementTrait;
        };

        $element1->setParent($super);
        $element11->setParent($element1);

        $this->assertEquals(new ElementsCollection([$super, $element1]), $element11->getParents());
    }

}