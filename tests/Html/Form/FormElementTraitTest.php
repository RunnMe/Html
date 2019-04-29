<?php

namespace Runn\tests\Html\Form\FormElementTrait;

use Runn\Html\Form\Errors\ElementValidationError;
use Runn\Html\Form\Errors\ElementValidationErrors;
use Runn\Html\Form\Form;
use Runn\Html\Form\FormElementInterface;
use Runn\Html\Form\FormElementTrait;
use PHPUnit\Framework\TestCase;


class FormElementTraitTest extends TestCase
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
