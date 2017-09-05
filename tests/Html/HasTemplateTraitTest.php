<?php

namespace Runn\tests\Html\HasTemplateTrait;

use Runn\Fs\File;
use Runn\Html\HasTemplateInterface;
use Runn\Html\HasTemplateTrait;

class HasTemplateTraitTest extends \PHPUnit_Framework_TestCase
{

    public function testSetGetValue()
    {
        $element = new class implements HasTemplateInterface {
            use HasTemplateTrait;
        };

        $this->assertNull($element->getTemplate());

        $template = new File(__FILE__);

        $res = $element->setTemplate($template);
        $this->assertSame($element, $res);
        $this->assertSame($template, $element->getTemplate());

        $res = $element->setTemplate(null);
        $this->assertSame($element, $res);
        $this->assertNull($element->getTemplate());
    }

}