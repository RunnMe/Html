<?php

namespace Runn\tests\Html\Rendering\functions;

use PHPUnit\Framework\TestCase;
use function Runn\Html\Rendering\escape;

class FunctionsTest extends TestCase
{

    public function testEscape()
    {
        $this->assertSame('', escape(''));
        $this->assertSame('&apos;', escape("'"));
        $this->assertSame("a\u{FFFD}b", escape("a\x80b"));
        $this->assertSame('Hello!', escape('Hello!'));
        $this->assertSame('Привет!', escape('Привет!'));
    }

}
