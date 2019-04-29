<?php

namespace Runn\tests\Html\Rendering\HasTemplateTrait;

use Runn\Fs\File;
use Runn\Html\Rendering\HasTemplateInterface;
use Runn\Html\Rendering\HasTemplateTrait;
use PHPUnit\Framework\TestCase;

class HasTemplateTraitTest extends TestCase
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
