<?php

namespace Runn\tests\Html\Form\ElementsSet;

use Runn\Html\Form\ElementsSet;
use Runn\Html\Form\Fields\NumberField;
use Runn\Html\Form\Fields\TextField;
use Runn\Html\ValidationError;
use Runn\Html\ValidationErrors;
use Runn\Validation\Validator;
use PHPUnit\Framework\TestCase;

class testTextField extends TextField
{
    public function getValidator(): Validator
    {
        echo $this->getValue();
        return parent::getValidator();
    }
}

class testNotEvenNumberField extends NumberField
{
    public function getValidator(): Validator
    {
        return new class extends Validator {
            public function validate($value): bool
            {
                if ($value % 2 == 0) {
                    throw new \Exception('Value is even');
                }
                return true;
            }
        };
    }
}

class ElementsSetValidationTest extends TestCase
{

    public function testValidate()
    {
        $set = new class extends ElementsSet {
            public static function getType() {
                return testTextField::class;
            }
        };

        ob_start();
        $set[] = new testTextField('foo', '1');
        $set[] = new testTextField('bar', '2');
        ob_end_clean();

        $this->expectOutputString('12');
        $set->validate();
    }

    public function testErrors()
    {
        $set = new class extends ElementsSet {
            public static function getType() {
                return testNotEvenNumberField::class;
            }
        };

        $set[] = new testNotEvenNumberField('foo', 0);
        $set[] = new testNotEvenNumberField('bar', 1);
        $set[] = new testNotEvenNumberField('baz', 2);

        $this->assertFalse($set->errors()->empty());
        $this->assertCount(2, $set->errors());

        $this->assertInstanceOf(ValidationErrors::class, $set->errors()[0]);
        $this->assertInstanceOf(ValidationErrors::class, $set->errors()[2]);

        $this->assertEquals(new ValidationErrors([
            new ValidationError($set[0], 0, 'Value is even', 0, new \Exception('Value is even'))
        ]), $set->errors()[0]);
        $this->assertEquals(new ValidationErrors([
            new ValidationError($set[2], 2, 'Value is even', 0, new \Exception('Value is even'))
        ]), $set->errors()[2]);
    }

}
