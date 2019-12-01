<?php

namespace Runn\tests\Html\HasValueValidationTrait;

use PHPUnit\Framework\TestCase;
use Runn\Core\Exception;
use Runn\Core\Exceptions;
use Runn\Html\HasValueValidationInterface;
use Runn\Html\HasValueValidationTrait;
use Runn\Html\HasValueInterface;
use Runn\Html\ValidationError;
use Runn\Html\ValidationErrors;
use Runn\Validation\Validator;

class validationReturnsTrue implements HasValueValidationInterface {

    use HasValueValidationTrait;

    public function getValidator(): Validator
    {
        return new class extends Validator {
            public function validate($value): bool
            {
                return true;
            }
        };
    }

}

class validationReturnsFalse implements HasValueValidationInterface {

    use HasValueValidationTrait;

    public function getValidator(): Validator
    {
        return new class extends Validator {
            public function validate($value): bool
            {
                return false;
            }
        };
    }

}

class validationWithOneException implements HasValueValidationInterface {

    use HasValueValidationTrait;

    public function getValidator(): Validator
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

class validationWithMultiExceptions implements HasValueValidationInterface {

    use HasValueValidationTrait;

    public function getValidator(): Validator
    {
        return new class extends Validator {
            public function validate($value): bool
            {
                if ($value % 2 == 0) {
                    throw new Exceptions([
                        new Exception('Value is even 1'),
                        new Exception('Value is even 2'),
                    ]);
                }
                return true;
            }
        };
    }

}

class HasValueValidationTraitTest extends TestCase
{

    public function testDefault()
    {
        $element = new class implements HasValueValidationInterface {
            use HasValueValidationTrait;
        };

        $this->assertInstanceOf(HasValueValidationInterface::class, $element);
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

    public function testTrue()
    {
        $element = new validationReturnsTrue();

        $this->assertInstanceOf(HasValueValidationInterface::class, $element);
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

    public function testFalse()
    {
        $element = new validationReturnsFalse();

        $this->assertInstanceOf(HasValueValidationInterface::class, $element);
        $this->assertInstanceOf(HasValueInterface::class, $element);

        $this->assertTrue($element->errors()->empty());
        $this->assertEquals(new ValidationErrors(), $element->errors());

        $element->setValue(42);

        $this->assertFalse($element->errors()->empty());
        $this->assertCount(1, $element->errors());
        $this->assertEquals(new ValidationErrors([
            new ValidationError($element, 42)
        ]), $element->errors());

        $res = $element->validate();

        $this->assertFalse($res);
        $this->assertFalse($element->errors()->empty());
        $this->assertCount(1, $element->errors());
        $this->assertEquals(new ValidationErrors([
            new ValidationError($element, 42)
        ]), $element->errors());
    }

    public function testOneException()
    {
        $element = new validationWithOneException();

        $this->assertInstanceOf(HasValueValidationInterface::class, $element);
        $this->assertInstanceOf(HasValueInterface::class, $element);

        $this->assertTrue($element->errors()->empty());
        $this->assertEquals(new ValidationErrors(), $element->errors());

        $element->setValue(42);

        $this->assertFalse($element->errors()->empty());
        $this->assertCount(1, $element->errors());
        $this->assertEquals(new ValidationErrors([
            new ValidationError($element, 42, 'Value is even', 0, new Exception('Value is even'))
        ]), $element->errors());
        $this->assertEquals(new Exception('Value is even'), $element->errors()[0]->getPrevious());

        $res = $element->validate();

        $this->assertFalse($res);
        $this->assertFalse($element->errors()->empty());
        $this->assertCount(1, $element->errors());
        $this->assertEquals(new ValidationErrors([
            new ValidationError($element, 42, 'Value is even', 0, new Exception('Value is even'))
        ]), $element->errors());
        $this->assertEquals(new Exception('Value is even'), $element->errors()[0]->getPrevious());

        $element->setValue(43);

        $this->assertTrue($element->errors()->empty());
        $this->assertEquals(new ValidationErrors(), $element->errors());

        $res = $element->validate();

        $this->assertTrue($res);
        $this->assertTrue($element->errors()->empty());
        $this->assertEquals(new ValidationErrors(), $element->errors());
    }

    public function testMultiExceptions()
    {
        $element = new validationWithMultiExceptions();

        $this->assertInstanceOf(HasValueValidationInterface::class, $element);
        $this->assertInstanceOf(HasValueInterface::class, $element);

        $this->assertTrue($element->errors()->empty());
        $this->assertEquals(new ValidationErrors(), $element->errors());

        $element->setValue(42);

        $this->assertFalse($element->errors()->empty());
        $this->assertCount(2, $element->errors());
        $this->assertEquals(new ValidationErrors([
            new ValidationError($element, 42, 'Value is even 1', 0, new Exception('Value is even 1')),
            new ValidationError($element, 42, 'Value is even 2', 0, new Exception('Value is even 2')),
        ]), $element->errors());
        $this->assertEquals(new Exception('Value is even 1'), $element->errors()[0]->getPrevious());
        $this->assertEquals(new Exception('Value is even 2'), $element->errors()[1]->getPrevious());

        $res = $element->validate();

        $this->assertFalse($res);
        $this->assertFalse($element->errors()->empty());
        $this->assertCount(2, $element->errors());
        $this->assertEquals(new ValidationErrors([
            new ValidationError($element, 42, 'Value is even 1', 0, new Exception('Value is even 1')),
            new ValidationError($element, 42, 'Value is even 2', 0, new Exception('Value is even 2')),
        ]), $element->errors());
        $this->assertEquals(new Exception('Value is even 1'), $element->errors()[0]->getPrevious());
        $this->assertEquals(new Exception('Value is even 2'), $element->errors()[1]->getPrevious());

        $element->setValue(43);

        $this->assertTrue($element->errors()->empty());
        $this->assertEquals(new ValidationErrors(), $element->errors());

        $res = $element->validate();

        $this->assertTrue($res);
        $this->assertTrue($element->errors()->empty());
        $this->assertEquals(new ValidationErrors(), $element->errors());
    }

}
