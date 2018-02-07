<?php

namespace Runn\tests\Html\Form\Buttons\SubmitButton;

use Runn\Html\Form\Buttons\SubmitButton;

class SubmitButtonTest extends \PHPUnit_Framework_TestCase
{

    public function testGetType()
    {
        $button = new SubmitButton();
        $this->assertSame('submit', $button->getType());
    }

    public function testTitle()
    {
        $button = new SubmitButton();
        $this->assertNull($button->getTitle());
        $this->assertSame('<button type="submit"></button>', $button->render());

        $button = new SubmitButton('foo');
        $this->assertSame('foo', $button->getTitle());
        $this->assertSame('<button type="submit">foo</button>', $button->render());
    }

}