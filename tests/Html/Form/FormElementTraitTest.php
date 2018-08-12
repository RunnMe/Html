<?php

namespace Runn\tests\Html\Form\FormElementTrait;

use Runn\Html\Form\Form;
use Runn\Html\Form\FormElementInterface;
use Runn\Html\Form\FormElementTrait;

class FormElementTraitTest extends \PHPUnit_Framework_TestCase
{

    public function testSetParentSimple()
    {
        $super = new class implements FormElementInterface { use FormElementTrait; };
        $element = new class implements FormElementInterface { use FormElementTrait; };

        $element->setParent($super);

        $this->assertSame($super, $element->getParent());
        $this->assertNull($element->getForm());
    }

    public function testSetParentForm()
    {
        $super = new Form();
        $element = new class implements FormElementInterface { use FormElementTrait; };

        $element->setParent($super);

        $this->assertSame($super, $element->getParent());
        $this->assertSame($super, $element->getForm());
    }

    public function testSetParentParentForm()
    {
        $form = new Form();
        $super = new class implements FormElementInterface { use FormElementTrait; };
        $element = new class implements FormElementInterface { use FormElementTrait; };

        $super->setParent($form);
        $element->setParent($super);

        $this->assertSame($super, $element->getParent());
        $this->assertSame($form, $element->getForm());
    }

}
