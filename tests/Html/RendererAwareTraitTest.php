<?php

namespace Runn\tests\Html\RendererAwareTrait;

use Runn\Html\RendererAwareInterface;
use Runn\Html\RendererAwareTrait;
use Runn\Html\RendererInterface;
use Runn\Html\Renderers\NativeRenderer;
use Runn\Storages\SingleValueStorageInterface;

class RendererAwareTraitTest extends \PHPUnit_Framework_TestCase
{

    public function testTrait()
    {
        $obj = new class implements RendererAwareInterface{ use RendererAwareTrait; };

        $this->assertEquals(new NativeRenderer(), $obj->getRenderer());

        $renderer = new class implements RendererInterface {
            /** @7.1 */
            public function render(SingleValueStorageInterface $template, iterable $data = null): string {
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