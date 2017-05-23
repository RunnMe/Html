<?php

namespace Runn\tests\Html\Form\Field;

use Runn\Core\Std;
use Runn\Html\Form\Field;
use Runn\Html\RenderableInterface;
use Runn\Storages\SingleValueStorageInterface;

class FieldTest extends \PHPUnit_Framework_TestCase
{

    public function testEmptyConstruct()
    {
        $field = new class extends Field {
            public function render(SingleValueStorageInterface $template = null): string {
                return 'Rendered!';
            }
        };

        $this->assertInstanceOf(Field::class, $field);
        $this->assertInstanceOf(RenderableInterface::class, $field);

        $this->assertInstanceOf(Std::class, $field->getAttributes());
        $this->assertCount(0, $field->getAttributes());
        $this->assertNull($field->getName());

        $this->assertInstanceOf(Std::class, $field->getOptions());
        $this->assertCount(0, $field->getOptions());
        $this->assertNull($field->getValue());

        $this->assertSame('Rendered!', $field->render());
    }

    public function testConstructAndName()
    {
        $field = new class('foo') extends Field {
            public function render(SingleValueStorageInterface $template = null): string {
                return 'Rendered!';
            }
        };

        $this->assertInstanceOf(Std::class, $field->getOptions());
        $this->assertCount(0, $field->getOptions());
        $this->assertNull($field->getValue());

        $this->assertInstanceOf(Std::class, $field->getAttributes());
        $this->assertCount(1, $field->getAttributes());
        $this->assertSame('foo', $field->getAttributes()->name);
        $this->assertSame('foo', $field->getName());

        $ret = $field->setName('bar');

        $this->assertSame($field, $ret);
        $this->assertCount(1, $field->getAttributes());
        $this->assertSame('bar', $field->getAttributes()->name);
        $this->assertSame('bar', $field->getName());
    }

    public function testConstructAndAttributes()
    {
        $field = new class(null, null, ['bar' => 'baz', 'bla' => 42], []) extends Field {
            public function render(SingleValueStorageInterface $template = null): string {
                return 'Rendered!';
            }
        };

        $this->assertInstanceOf(Std::class, $field->getAttributes());
        $this->assertCount(2, $field->getAttributes());

        $this->assertSame('baz', $field->getAttributes()->bar);
        $this->assertSame('42',  $field->getAttributes()->bla);
    }

    public function testConstructAndOptions()
    {
        $field = new class('foo', null, [], ['bar' => 'baz', 'bla' => 42]) extends Field {
            public function render(SingleValueStorageInterface $template = null): string {
                return 'Rendered!';
            }
        };

        $this->assertInstanceOf(Std::class, $field->getOptions());
        $this->assertCount(2, $field->getOptions());

        $this->assertSame('baz', $field->getOptions()->bar);
        $this->assertSame(42,    $field->getOptions()->bla);
    }

    public function testName()
    {
        $field = new class('foo', null, ['bar' => 'baz', 'bla' => 42], []) extends Field {
            public function render(SingleValueStorageInterface $template = null): string {
                return 'Rendered!';
            }
        };

        $this->assertInstanceOf(Std::class, $field->getAttributes());
        $this->assertCount(3, $field->getAttributes());

        $this->assertSame('baz', $field->getAttributes()->bar);
        $this->assertSame('42',  $field->getAttributes()->bla);

        $this->assertSame('foo', $field->getAttributes()->name);
        $this->assertSame('foo', $field->getName());

        $ret = $field->setName('test');

        $this->assertSame($field, $ret);
        $this->assertSame('test', $field->getAttributes()->name);
        $this->assertSame('test', $field->getName());
    }

    public function testValue()
    {
        $field = new class('foo', 'somevalue') extends Field {
            public function render(SingleValueStorageInterface $template = null): string {
                return 'Rendered!';
            }
        };

        $this->assertInstanceOf(Std::class, $field->getOptions());
        $this->assertCount(1, $field->getOptions());
        $this->assertSame('somevalue', $field->getOptions()->value);
        $this->assertSame('somevalue', $field->getValue());

        $ret = $field->setValue('test');

        $this->assertSame($field, $ret);
        $this->assertSame('test', $field->getOptions()->value);
        $this->assertSame('test', $field->getValue());
    }

    public function testEscape()
    {
        $field = new class extends Field {
            public function render(SingleValueStorageInterface $template = null): string {
                return $this->escape($this->getValue());
            }
        };

        $this->assertSame('42', $field->setValue(42)->render());
        $this->assertSame('foo', $field->setValue('foo')->render());
        $this->assertSame('&quot;foo&amp;', $field->setValue('"foo&')->render());
    }

}