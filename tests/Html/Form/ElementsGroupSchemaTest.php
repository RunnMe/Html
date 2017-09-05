<?php

namespace Runn\tests\Html\Form\ElementsGroup;

use Runn\Html\Form\ElementsGroup;
use Runn\Html\Form\Fields\TextareaField;
use Runn\Html\Form\Fields\TextField;

class testElementsGroupSchema extends ElementsGroup {
    protected static $schema = [
        'foo' => [
            'class' => TextField::class,
        ],
        'field1' => [
            'class' => TextField::class,
            'title' => 'Title One',
            'name' => 'name1',
            'value' => 'value1',
        ],
        'field2' => [
            'class' => TextareaField::class,
            'attributes' => ['foo' => 'bar', 'baz' => 42],
            'options'    => ['foo' => 'bar', 'baz' => 42],
        ],
    ];
}

class testElementsGroupNested extends ElementsGroup {
    protected static $schema = [
        'test' => [
            'class' => TextField::class,
        ],
        'inner' => [
            'class' => testElementsGroupSchema::class,
        ],
    ];
}

class ElementsGroupSchemaTest extends \PHPUnit_Framework_TestCase
{

    public function testGetSchema()
    {
        $prop = new \ReflectionProperty(testElementsGroupSchema::class, 'schema');
        $prop->setAccessible(true);

        $group = new testElementsGroupSchema;

        $this->assertSame($prop->getValue(), $group->getSchema());
        $this->assertSame($prop->getValue(), testElementsGroupSchema::getSchema());
    }

    public function testEmptySchema()
    {
        $group = new class extends ElementsGroup {};
        $this->assertCount(0, $group);
    }

    /**
     * @expectedException \Runn\Html\Form\Exception
     * @expectedExceptionMessage Invalid group schema: class for element "foo" is missing
     */
    public function testSchemaEmptyClass()
    {
        $group = new class extends ElementsGroup {
            protected static $schema = [
                'foo' => [
                    'noclass' => 'empty',
                ],
            ];
        };
    }

    /**
     * @expectedException \Runn\Html\Form\Exception
     * @expectedExceptionMessage Invalid group schema: class for element "foo" is not a form element class
     */
    public function testSchemaInvalidClass()
    {
        $group = new class extends ElementsGroup {
            protected static $schema = [
                'foo' => [
                    'class' => \stdClass::class,
                ],
            ];
        };
    }

    public function testSchema()
    {
        $group = new testElementsGroupSchema;

        $this->assertCount(3, $group);

        // foo:

        $this->assertInstanceOf(TextField::class, $group->foo);
        $this->assertSame($group, $group->foo->getParent());

        $this->assertSame('foo', $group->foo->getName());
        $this->assertNull($group->foo->getValue());

        $this->assertCount(2, $group->foo->getAttributes());
        $this->assertSame('text', $group->foo->getAttributes()->type);
        $this->assertSame('foo', $group->foo->getAttributes()->name);

        $this->assertNull($group->foo->getOptions());

        // field1:

        $this->assertInstanceOf(TextField::class, $group->field1);
        $this->assertSame($group, $group->field1->getParent());

        $this->assertSame('name1', $group->field1->getName());
        $this->assertSame('Title One', $group->field1->getTitle());
        $this->assertSame('value1', $group->field1->getValue());

        $this->assertCount(3, $group->field1->getAttributes());
        $this->assertSame('text', $group->field1->getAttributes()->type);
        $this->assertSame('Title One', $group->field1->getAttributes()->title);
        $this->assertSame('name1', $group->field1->getAttributes()->name);

        $this->assertNull($group->foo->getOptions());

        // field2 :

        $this->assertInstanceOf(TextareaField::class, $group->field2);
        $this->assertSame($group, $group->field2->getParent());

        $this->assertSame('field2', $group->field2->getName());
        $this->assertNull($group->field2->getValue());

        $this->assertCount(3, $group->field2->getAttributes());
        $this->assertSame('field2', $group->field2->getAttributes()->name);
        $this->assertSame('bar', $group->field2->getAttributes()->foo);
        $this->assertSame('42', $group->field2->getAttributes()->baz);

        $this->assertCount(2, $group->field2->getOptions());
        $this->assertSame('bar', $group->field2->getOptions()->foo);
        $this->assertSame(42, $group->field2->getOptions()->baz);
    }

    public function testNestedGroup()
    {
        $group = new testElementsGroupNested();

        $this->assertCount(2, $group);

        // test:

        $this->assertInstanceOf(TextField::class, $group->test);
        $this->assertSame($group, $group->test->getParent());

        $this->assertSame('test', $group->test->getName());
        $this->assertNull($group->test->getValue());

        // inner:

        $this->assertInstanceOf(ElementsGroup::class, $group->inner);
        $this->assertSame($group, $group->inner->getParent());
        $this->assertCount(3, $group->inner);
    }

}