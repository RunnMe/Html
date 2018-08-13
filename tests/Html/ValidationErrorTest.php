<?php

namespace Runn\tests\Html\Form\Errors\ElementValidationError;

use Runn\Html\Form\Fields\BooleanField;
use Runn\Html\Form\Fields\NumberField;
use Runn\Html\ValidationError;

class ValidationErrorTest extends \PHPUnit_Framework_TestCase
{

    public function testConstruct()
    {
        $element = new BooleanField();
        $ex = new ValidationError($element, 42, 'Invalid value');

        $this->assertInstanceOf(ValidationError::class, $ex);
        $this->assertSame($element, $ex->getElement());
        $this->assertSame(42, $ex->getValue());
        $this->assertSame('Invalid value', $ex->getMessage());

        $element = new NumberField('foo', 24);
        $ex = new ValidationError($element);

        $this->assertInstanceOf(ValidationError::class, $ex);
        $this->assertSame($element, $ex->getElement());
        $this->assertSame(24, $ex->getValue());
        $this->assertSame('', $ex->getMessage());
    }

}
