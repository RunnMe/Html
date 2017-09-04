<?php

namespace Runn\tests\Html\RendererAwareTrait;

use Runn\Html\RendererAwareInterface;
use Runn\Html\RendererAwareTrait;
use Runn\Html\RendererInterface;
use Runn\Storages\SingleValueStorageInterface;

class RendererAwareTraitTest extends \PHPUnit_Framework_TestCase
{

    public function testTrait()
    {
        $obj = new class implements RendererAwareInterface{ use RendererAwareTrait; };
        // @7.1
        //$this->assertNull($obj->getRenderer());

        $renderer = new class implements RendererInterface {
            /** @7.1 */
            public function render(SingleValueStorageInterface $template, iterable $data = null): string {
                return 'test';
            }
        };

        $ret = $obj->setRenderer($renderer);
        $this->assertSame($renderer, $obj->getRenderer());
        $this->assertSame($obj, $ret);
    }

}