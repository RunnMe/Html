<?php

namespace Runn\tests\Html\Rendering\RendererAwareTrait;

use Runn\Html\Rendering\RendererAwareInterface;
use Runn\Html\Rendering\RendererAwareTrait;
use Runn\Html\Rendering\RendererInterface;
use Runn\Html\Rendering\Renderers\NativeRenderer;
use Runn\Storages\SingleValueStorageInterface;

class RendererAwareTraitTest extends \PHPUnit_Framework_TestCase
{

    public function testTrait()
    {
        $obj = new class implements RendererAwareInterface{ use RendererAwareTrait; };

        $this->assertEquals(new NativeRenderer(), $obj->getRenderer());

        $renderer = new class implements RendererInterface {
            /** @7.1 */
            public function render(SingleValueStorageInterface $template, /*iterable */$data = null): string {
                return 'test';
            }
        };

        $ret = $obj->setRenderer($renderer);
        $this->assertSame($obj, $ret);
        $this->assertSame($renderer, $obj->getRenderer());

        $ret = $obj->setRenderer(null);
        $this->assertSame($obj, $ret);
        $this->assertEquals(new NativeRenderer(), $obj->getRenderer());
    }

}
