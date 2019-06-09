<?php

namespace Runn\tests\Html\HasOptionsTrait;

use PHPUnit\Framework\TestCase;
use Runn\Core\Std;
use Runn\Html\HasOptionsInterface;
use Runn\Html\HasOptionsTrait;

class HasOptionsTraitTest extends TestCase
{

    public function testOptions()
    {
        $element = new class implements HasOptionsInterface {
            use HasOptionsTrait;
        };

        $this->assertNull($element->getOptions());
        $this->assertNull($element->getOption('opt1'));
        $this->assertNull($element->getOption('opt2'));
        $this->assertFalse($element->issetOption('opt1'));
        $this->assertFalse($element->issetOption('opt2'));

        $ret = $element->setOption('opt1', null);

        $this->assertSame($element, $ret);
        $this->assertCount(1, $element->getOptions());
        $this->assertSame(null, $element->getOptions()->opt1);
        $this->assertSame(null, $element->getOption('opt1'));
        $this->assertTrue($element->issetOption('opt1'));
        $this->assertFalse($element->issetOption('opt2'));

        $ret = $element->setOption('opt1', 'val1');

        $this->assertSame($element, $ret);
        $this->assertCount(1, $element->getOptions());
        $this->assertSame('val1',  $element->getOptions()->opt1);
        $this->assertSame('val1',  $element->getOption('opt1'));
        $this->assertTrue($element->issetOption('opt1'));
        $this->assertFalse($element->issetOption('opt2'));

        $element->setOptions(['opt1' => 1, 'opt2' => 2]);

        $this->assertCount(2, $element->getOptions());
        $this->assertSame(1,  $element->getOptions()->opt1);
        $this->assertSame(1,  $element->getOption('opt1'));
        $this->assertSame(2,  $element->getOptions()->opt2);
        $this->assertSame(2,  $element->getOption('opt2'));
        $this->assertTrue($element->issetOption('opt1'));
        $this->assertTrue($element->issetOption('opt2'));

        $element->setOptions(new Std(['opt11' => 11, 'opt22' => '22']));

        $this->assertCount(2, $element->getOptions());
        $this->assertSame(11,    $element->getOptions()->opt11);
        $this->assertSame(11,    $element->getOption('opt11'));
        $this->assertSame('22',  $element->getOptions()->opt22);
        $this->assertSame('22',  $element->getOption('opt22'));
        $this->assertTrue($element->issetOption('opt11'));
        $this->assertTrue($element->issetOption('opt22'));

        $element->unsetOption('opt11');
        $this->assertCount(1, $element->getOptions());
        $this->assertFalse($element->issetOption('opt11'));
        $this->assertTrue($element->issetOption('opt22'));

        $element->setOptions(null);
        $this->assertNull($element->getOptions());
        $this->assertFalse($element->issetOption('opt11'));
        $this->assertFalse($element->issetOption('opt22'));
    }

}
