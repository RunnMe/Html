<?php

namespace Runn\tests\Html\Form\ElementsGroup;

use Runn\Core\Exception;
use Runn\Html\Form\ElementsGroup;
use Runn\Html\Form\Fields\NumberField;
use Runn\Html\Form\Fields\TextField;
use Runn\Html\ValidationError;
use Runn\Html\ValidationErrors;
use Runn\Validation\Validator;

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

class ElementsGroupValidationTest extends \PHPUnit_Framework_TestCase
{

    public function testValidate()
    {
        $group = new class extends ElementsGroup {};

        ob_start();
        $group->foo = new testTextField('foo', '1');
        $group->bar = new testTextField('bar', '2');
        ob_end_clean();

        $this->expectOutputString('12');
        $group->validate();
    }

    public function testErrors()
    {
        $group = new class extends ElementsGroup {};

        $group->foo = new testNotEvenNumberField('foo', 0);
        $group->bar = new testNotEvenNumberField('bar', 1);
        $group->baz = new testNotEvenNumberField('baz', 2);

        $this->assertFalse($group->errors()->empty());
        $this->assertCount(2, $group->errors());

        $this->assertInstanceOf(ValidationErrors::class, $group->errors()['foo']);
        $this->assertInstanceOf(ValidationErrors::class, $group->errors()['baz']);

        $this->assertEquals(new ValidationErrors([
            new ValidationError($group->foo, 0, 'Value is even', 0, new \Exception('Value is even'))
        ]), $group->errors()['foo']);
        $this->assertEquals(new ValidationErrors([
            new ValidationError($group->baz, 2, 'Value is even', 0, new \Exception('Value is even'))
        ]), $group->errors()['baz']);
    }

    public function testNestedErrors()
    {
        $group1 = new class extends ElementsGroup {};
        $group1->foo = new testNotEvenNumberField('foo', 0);
        $group1->bar = new testNotEvenNumberField('bar', 1);

        $group2 = new class extends ElementsGroup {};
        $group2->baz = new testNotEvenNumberField('baz', 2);
        $group2->bla = new testNotEvenNumberField('bla', 3);

        $super = new class extends ElementsGroup {};
        $super->one = $group1;
        $super->two = $group2;

        $this->assertFalse($super->errors()->empty());
        $this->assertCount(2, $super->errors());

        $this->assertEquals(new ValidationErrors([
            new ValidationError($super->one->foo, 0, 'Value is even', 0, new \Exception('Value is even'))
        ]), $super->errors()['one']['foo']);
        $this->assertEquals(new ValidationErrors([
            new ValidationError($super->two->baz, 2, 'Value is even', 0, new \Exception('Value is even'))
        ]), $super->errors()['two']['baz']);
    }

}
