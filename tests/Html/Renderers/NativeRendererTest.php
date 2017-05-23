<?php

namespace Runn\tests\Html\Renderers\NativeRenderer;

use Runn\Core\Std;
use Runn\Fs\File;
use Runn\Html\Renderers\NativeRenderer;
use Runn\Storages\SingleValueStorageInterface;

class testStorage implements SingleValueStorageInterface
{
    public function load() {}
    public function save() {}
    public function get() {
        return 'Foo by storage: <?php echo $foo; ?>; Baz by storage: <?php echo $baz; ?>';
    }
    public function set($value) {}
}

class NativeRendererTest extends \PHPUnit_Framework_TestCase
{

    public function testRenderByFile()
    {
        $data = new Std(['foo' => 'bar', 'baz' => 42]);
        $template = new File(__DIR__ . '/nativetemplate.php');

        $this->assertSame("Foo: bar; Baz: 42", (new NativeRenderer)->render($data, $template));
    }

    public function testRenderByStorage()
    {
        $data = new Std(['foo' => 'bar', 'baz' => 42]);
        $template = new testStorage();

        $this->assertSame("Foo by storage: bar; Baz by storage: 42", (new NativeRenderer)->render($data, $template));
    }

}