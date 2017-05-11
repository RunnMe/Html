<?php

namespace Runn\tests\Html\BelongsToFormTrait;

use Runn\Html\BelongsToFormInterface;
use Runn\Html\BelongsToFormTrait;
use Runn\Html\Form;

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