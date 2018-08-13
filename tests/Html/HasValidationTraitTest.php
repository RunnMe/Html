<?php

namespace Runn\tests\Html\HasValidationTrait;

use Runn\Core\Exception;
use Runn\Html\HasValidationInterface;
use Runn\Html\HasValidationTrait;
use Runn\Html\HasValueInterface;
use Runn\Html\ValidationError;
use Runn\Html\ValidationErrors;
use Runn\Validation\Validator;

class validationReturnsTrue implements HasValidationInterface {

    use HasValidationTrait;

    protected function getValidator(): Validator
    {
        return new class extends Validator {
            public function validate($value): bool
            {
                return true;
            }
        };
    }

}

class validationWithOneException implements HasValidationInterface {

    use HasValidationTrait;

    protected function getValidator(): Validator
    {
        return new class extends Validator {
            public function validate($value): bool
            {
                if ($value % 2 == 0) {
                    throw new Exception('Value is even');
                }
                return true;
            }
        };
    }

}

class HasValidationTraitTest extends \PHPUnit_Framework_TestCase
{

    public function testDefault()
    {
        $element = new class implements HasValidationInterface {
            use HasValidationTrait;
        };

        $this->assertInstanceOf(HasValidationInterface::class, $element);
        $this->assertInstanceOf(HasValueInterface::class, $element);

        $this->assertTrue($element->errors()->empty());
        $this->assertEquals(new ValidationErrors(), $element->errors());

        $element->setValue(42);

        $this->assertTrue($element->errors()->empty());
        $this->assertEquals(new ValidationErrors(), $element->errors());

        $res = $element->validate();

        $this->assertTrue($res);
        $this->assertTrue($element->errors()->empty());
        $this->assertEquals(new ValidationErrors(), $element->errors());
    }

    public function testTrueSetValue()
    {
        $element = new validationReturnsTrue();

        $this->assertInstanceOf(HasValidationInterface::class, $element);
        $this->assertInstanceOf(HasValueInterface::class, $element);

        $this->assertTrue($element->errors()->empty());
        $this->assertEquals(new ValidationErrors(), $element->errors());

        $element->setValue(42);

        $this->assertTrue($element->errors()->empty());
        $this->assertEquals(new ValidationErrors(), $element->errors());

        $res = $element->validate();

        $this->assertTrue($res);
        $this->assertTrue($element->errors()->empty());
        $this->assertEquals(new ValidationErrors(), $element->errors());
    }

    public function testOneExceptionSetValue()
    {
        $element = new validationWithOneException();

        $this->assertInstanceOf(HasValidationInterface::class, $element);
        $this->assertInstanceOf(HasValueInterface::class, $element);

        $this->assertTrue($element->errors()->empty());
        $this->assertEquals(new ValidationErrors(), $element->errors());

        $element->setValue(42);

        $this->assertFalse($element->errors()->empty());
        $this->assertEquals(new ValidationErrors([
            new ValidationError($element, 42, 'Value is even')
        ]), $element->errors());

        $res = $element->validate();

        $this->assertFalse($res);
        $this->assertFalse($element->errors()->empty());
        $this->assertEquals(new ValidationErrors([
            new ValidationError($element, 42, 'Value is even')
        ]), $element->errors());

        $element->setValue(43);

        $this->assertTrue($element->errors()->empty());
        $this->assertEquals(new ValidationErrors(), $element->errors());

        $res = $element->validate();

        $this->assertTrue($res);
        $this->assertTrue($element->errors()->empty());
        $this->assertEquals(new ValidationErrors(), $element->errors());
    }

}
