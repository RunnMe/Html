<?php

namespace Runn\tests\Html\Form\Field;

use Runn\Core\Exceptions;
use Runn\Html\Form\Field;
use Runn\Html\ValidationError;
use Runn\Validation\Validator;

class FieldValidationTest extends \PHPUnit_Framework_TestCase
{

    public function testValidatorReturnsTrue()
    {
        $field = new class('foo', 42) extends Field {
            protected function getValidator(): Validator {
                return new class extends Validator {
                    public function validate($value): bool {
                        return true;
                    }
                };
            }
        };

        $this->assertTrue($field->errors()->empty());
        $this->assertCount(0, $field->errors());
    }

    public function testValidatorReturnsFalse()
    {
        $field = new class('foo', 42) extends Field {
            protected function getValidator(): Validator {
                return new class extends Validator {
                    public function validate($value): bool {
                        return false;
                    }
                };
            }
        };

        $this->assertFalse($field->errors()->empty());
        $this->assertCount(1, $field->errors());

        $this->assertInstanceOf(ValidationError::class, $field->errors()[0]);
        $this->assertSame($field, $field->errors()[0]->getElement());
        $this->assertSame(42, $field->errors()[0]->getValue());
        $this->assertEmpty($field->errors()[0]->getMessage());
    }

    public function testSingleErrorValidator()
    {
        $field = new class('foo', 42) extends Field {
            protected function getValidator(): Validator {
                return new class extends Validator {
                    public function validate($value): bool {
                        throw new \Exception('Invalid value');
                    }
                };
            }
        };

        $this->assertFalse($field->errors()->empty());
        $this->assertCount(1, $field->errors());

        $this->assertInstanceOf(ValidationError::class, $field->errors()[0]);
        $this->assertSame($field, $field->errors()[0]->getElement());
        $this->assertSame(42, $field->errors()[0]->getValue());
        $this->assertSame('Invalid value', $field->errors()[0]->getMessage());
    }

    public function testMultiErrorsValidator()
    {
        $field = new class('foo', 42) extends Field {
            protected function getValidator(): Validator {
                return new class extends Validator {
                    public function validate($value): bool {
                        throw new Exceptions([
                            new \Exception('Invalid value 1'),
                            new \Exception('Invalid value 2'),
                        ]);
                    }
                };
            }
        };

        $this->assertFalse($field->errors()->empty());
        $this->assertCount(2, $field->errors());

        $this->assertInstanceOf(ValidationError::class, $field->errors()[0]);
        $this->assertSame($field, $field->errors()[0]->getElement());
        $this->assertSame(42, $field->errors()[0]->getValue());
        $this->assertSame('Invalid value 1', $field->errors()[0]->getMessage());

        $this->assertInstanceOf(ValidationError::class, $field->errors()[1]);
        $this->assertSame($field, $field->errors()[1]->getElement());
        $this->assertSame(42, $field->errors()[1]->getValue());
        $this->assertSame('Invalid value 2', $field->errors()[1]->getMessage());
    }

}
