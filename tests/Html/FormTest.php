<?php

namespace Runn\tests\Html\Form;

use Runn\Html\Form;
use Runn\Html\Form\ElementsGroup;

class FormTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @expectedException \BadMethodCallException
     */
    public function testSetParent1()
    {
        $group = new class extends ElementsGroup {};
        $form = new Form;
        $form->setParent($group);
    }

    /**
     * @expectedException \BadMethodCallException
     */
    public function testSetParent2()
    {
        $group = new class extends ElementsGroup {};
        $form = new Form;
        $group->part = $form;
    }

}