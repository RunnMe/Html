<?php

namespace Runn\tests\Html\Form\Button;

use Runn\Core\Std;
use Runn\Html\Form\Button;
use Runn\Html\Form\FormButtonInterface;
use Runn\Html\Form\FormElementInterface;
use Runn\Html\HasAttributesInterface;
use Runn\Html\RenderableInterface;
use Runn\Storages\SingleValueStorageInterface;

class ButtonTest extends \PHPUnit_Framework_TestCase
{

    public function testEmptyConstruct()
    {
        $button = new class extends Button {};

        $this->assertInstanceOf(FormElementInterface::class, $button);
        $this->assertInstanceOf(HasAttributesInterface::class, $button);
        $this->assertInstanceOf(RenderableInterface::class, $button);
        $this->assertInstanceOf(FormButtonInterface::class, $button);

        $this->assertInstanceOf(Std::class, $button->getAttributes());
        $this->assertCount(1, $button->getAttributes());
        $this->assertEquals(new Std(['type' => Button::DEFAULT_TYPE]), $button->getAttributes());
        $this->assertSame(Button::DEFAULT_TYPE, $button->getAttributes()->type);
        $this->assertSame(Button::DEFAULT_TYPE, $button->getType());

        $this->assertNull($button->getTitle());

        $this->assertSame('<button type="submit"></button>', $button->render());
    }

    public function testConstructAndType()
    {
        $button = new class('submit') extends Button {};

        $this->assertInstanceOf(FormElementInterface::class, $button);
        $this->assertInstanceOf(HasAttributesInterface::class, $button);
        $this->assertInstanceOf(RenderableInterface::class, $button);
        $this->assertInstanceOf(FormButtonInterface::class, $button);

        $this->assertInstanceOf(Std::class, $button->getAttributes());
        $this->assertCount(1, $button->getAttributes());
        $this->assertEquals(new Std(['type' => 'submit']), $button->getAttributes());
        $this->assertSame('submit', $button->getAttributes()->type);
        $this->assertSame('submit', $button->getType());

        $this->assertNull($button->getTitle());

        $this->assertSame('<button type="submit"></button>', $button->render());

        $button->setType('reset');

        $this->assertInstanceOf(Std::class, $button->getAttributes());
        $this->assertCount(1, $button->getAttributes());
        $this->assertEquals(new Std(['type' => 'reset']), $button->getAttributes());
        $this->assertSame('reset', $button->getAttributes()->type);
        $this->assertSame('reset', $button->getType());

        $this->assertSame('<button type="reset"></button>', $button->render());
    }

    public function testTitle()
    {
        $button = new class('submit', 'sometitle') extends Button {};

        $this->assertInstanceOf(FormElementInterface::class, $button);
        $this->assertInstanceOf(HasAttributesInterface::class, $button);
        $this->assertInstanceOf(RenderableInterface::class, $button);
        $this->assertInstanceOf(FormButtonInterface::class, $button);

        $this->assertInstanceOf(Std::class, $button->getAttributes());
        $this->assertCount(1, $button->getAttributes());
        $this->assertEquals(new Std(['type' => 'submit']), $button->getAttributes());
        $this->assertSame('submit', $button->getAttributes()->type);
        $this->assertSame('submit', $button->getType());

        $this->assertSame('sometitle', $button->getTitle());
        $this->assertSame('<button type="submit">sometitle</button>', $button->render());

        $button->setTitle('anothertitle');

        $this->assertSame('anothertitle', $button->getTitle());
        $this->assertSame('<button type="submit">anothertitle</button>', $button->render());
    }

    public function testEscape()
    {
        $button = new class extends Button {
            public function render(SingleValueStorageInterface $template = null): string {
                return $this->escape($this->getTitle());
            }
        };

        $this->assertSame('42', $button->setTitle(42)->render());
        $this->assertSame('foo', $button->setTitle('foo')->render());
        $this->assertSame('&quot;foo&amp;', $button->setTitle('"foo&')->render());
    }

}