<?php

namespace Runn\tests\Html\Form\BelongsToFormTrait;

use Runn\Html\Form\BelongsToFormInterface;
use Runn\Html\Form\BelongsToFormTrait;
use Runn\Html\Form\Form;

class BelongsToFormTraitTest extends \PHPUnit_Framework_TestCase
{

    public function testSetGetForm()
    {
        $element = new class implements BelongsToFormInterface {
            use BelongsToFormTrait;
        };

        $this->assertFalse($element->belongsToForm());
        $this->assertNull($element->getForm());

        $form = new Form;
        $element->setForm($form);

        $this->assertTrue($element->belongsToForm());
        $this->assertSame($form, $element->getForm());
    }

}