<?php

namespace Runn\tests\Html\Form\Form;

use PHPUnit\Framework\TestCase;
use Runn\Core\Exception;
use Runn\Html\Form\Fields\BooleanField;
use Runn\Html\Form\Fields\NumberField;
use Runn\Html\Form\Fields\PasswordField;
use Runn\Html\Form\Fields\TextField;
use Runn\Html\Form\Form;
use Runn\Html\Form\ElementsGroup;
use Runn\Html\ValidationErrors;
use Runn\Validation\ValidationError;
use Runn\Validation\Validators\BooleanValidator;
use Runn\Validation\Validators\IntValidator;

class FormTest extends TestCase
{

    public function testSetParent1()
    {
        $group = new class extends ElementsGroup {};
        $form = new Form;

        $this->expectException(\BadMethodCallException::class);
        $form->setParent($group);
    }

    public function testSetParent2()
    {
        $group = new class extends ElementsGroup {};
        $form = new Form;

        $this->expectException(\BadMethodCallException::class);
        $group->part = $form;
    }

    public function testAction()
    {
        $form = new Form;
        $this->assertNull($form->getAttribute('action'));

        $ret = $form->action();

        $this->assertSame($form, $ret);
        $this->assertNull($form->getAttribute('action'));

        $ret = $form->action('index.php');

        $this->assertSame($form, $ret);
        $this->assertSame('index.php', $form->getAttribute('action'));
    }

    public function testMethod()
    {
        $form = new Form;
        $this->assertNull($form->getAttribute('method'));

        $ret = $form->method();

        $this->assertSame($form, $ret);
        $this->assertNull($form->getAttribute('method'));

        $ret = $form->method('get');

        $this->assertSame($form, $ret);
        $this->assertSame('get', $form->getAttribute('method'));
    }

    public function testRender()
    {
        $form =
            (new Form(['login' => new TextField, 'p' => new PasswordField('pass')]))
            ->setAttribute('action', 'index.php');
        $form->repeat = new PasswordField;

        $this->assertSame(
            str_replace("\n", PHP_EOL, "<form action=\"index.php\">\n    <input type=\"text\" name=\"login\">\n    <input type=\"password\" name=\"pass\">\n    <input type=\"password\" name=\"repeat\">\n</form>"),
            $form->render()
        );
    }

    public function testRenderWithErrors()
    {
        $form =
            (new Form(['foo' => new NumberField, 'bar' => new BooleanField]));
        $form->foo->setValidator(new class extends IntValidator {
            public function validate($value): bool {
                if (!is_int($value)) {
                    throw new Exception('Invalid foo');
                }
                return true;
            }
        });
        $form->bar->setValidator(new class extends BooleanValidator {
            public function validate($value): bool {
                if (!is_bool($value)) {
                    throw new Exception('Invalid bar');
                }
                return true;
            }
        });

        $form->setValue(['foo' => 'bla', 'bar' => 42]);

        $errors = $form->errors();

        $this->assertInstanceOf(ValidationErrors::class, $errors);
        $this->assertCount(2, $errors);

        $this->assertSame($errors['foo'], $form->foo->errors());
        $this->assertSame($errors['bar'], $form->bar->errors());

        $this->assertInstanceOf(ValidationErrors::class, $errors['foo']);
        $this->assertCount(1, $errors['foo']);

        $this->assertInstanceOf(ValidationErrors::class, $errors['bar']);
        $this->assertCount(1, $errors['bar']);

        $this->assertInstanceOf(ValidationError::class, $errors['foo'][0]);
        $this->assertInstanceOf(ValidationError::class, $errors['bar'][0]);

        $this->assertSame('Invalid foo', $errors['foo'][0]->getMessage());
        $this->assertSame('Invalid bar', $errors['bar'][0]->getMessage());

        $this->assertSame(
            str_replace("\n", PHP_EOL, "<form>\n    Invalid foo<br><input type=\"number\" name=\"foo\" value=\"bla\">\n    Invalid bar<br><input type=\"hidden\" name=\"bar\" value=\"0\"><input type=\"checkbox\" checked name=\"bar\" value=\"1\">\n</form>"),
            $form->render()
        );
    }

}
