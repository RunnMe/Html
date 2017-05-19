<?php

namespace Runn\tests\Html\HasOptionsTrait;

use Runn\Core\Std;
use Runn\Html\HasOptionsInterface;
use Runn\Html\HasOptionsTrait;

class HasOptionsTraitTest extends \PHPUnit_Framework_TestCase
{

    public function testOptions()
    {
        $element = new class implements HasOptionsInterface {
            use HasOptionsTrait;
        };

        $this->assertNull($element->getOptions());

        $ret = $element->setOption('opt1', 'val1');

        $this->assertSame($element, $ret);
        $this->assertCount(1, $element->getOptions());
        $this->assertSame('val1',  $element->getOptions()->opt1);
        $this->assertSame('val1',  $element->getOption('opt1'));

        $element->setOptions(['opt1' => 1, 'opt2' => 2]);

        $this->assertCount(2, $element->getOptions());
        $this->assertSame(1,  $element->getOptions()->opt1);
        $this->assertSame(1,  $element->getOption('opt1'));
        $this->assertSame(2,  $element->getOptions()->opt2);
        $this->assertSame(2,  $element->getOption('opt2'));

        $element->setOptions(new Std(['opt11' => 11, 'opt22' => '22']));

        $this->assertCount(2, $element->getOptions());
        $this->assertSame(11,    $element->getOptions()->opt11);
        $this->assertSame(11,    $element->getOption('opt11'));
        $this->assertSame('22',  $element->getOptions()->opt22);
        $this->assertSame('22',  $element->getOption('opt22'));
    }

}