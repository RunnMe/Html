<?php

namespace Runn\tests\Html\Form\Errors\ElementValidationError;

use Runn\Html\Form\Errors\ElementValidationError;
use Runn\Html\Form\Fields\BooleanField;

class ElementValidationErrorTest extends \PHPUnit_Framework_TestCase
{

    public function testConstruct()
    {
        $element = new BooleanField();
        $ex = new ElementValidationError($element, 42, 'Invalid value');

        $this->assertInstanceOf(ElementValidationError::class, $ex);
        $this->assertSame($element, $ex->getElement());
        $this->assertSame(42, $ex->getValue());
        $this->assertSame('Invalid value', $ex->getMessage());
    }

}
