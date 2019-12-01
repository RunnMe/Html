<?php

namespace Runn\tests\Html\Rendering\Renderers\NativeRenderer;

use PHPUnit\Framework\TestCase;
use Runn\Core\Std;
use Runn\Fs\File;
use Runn\Html\Rendering\Renderers\NativeRenderer;
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

class testStorageWithoutThis extends testStorage
{
    public function get() {
        return 'Class: <?php echo get_class($this); ?>;';
    }
}

class testStorageWithThis extends testStorage
{
    public function get() {
        return 'Foo by this: <?php echo $this->foo; ?>; Baz by this: <?php echo $this->baz; ?>;';
    }
}

class NativeRendererTest extends TestCase
{

    public function testRenderByFile()
    {
        $data = ['foo' => 'bar', 'baz' => 42];
        $template = new File(__DIR__ . '/native.template.php');

        $this->assertSame("Foo: bar; Baz: 42", (new NativeRenderer)->render($template, $data));

        $data = new Std(['foo' => 'bla', 'baz' => 13]);
        $template = new File(__DIR__ . '/native.template.php');

        $this->assertSame("Foo: bla; Baz: 13", (new NativeRenderer)->render($template, $data));
    }

    public function testRenderByStorage()
    {
        $data = ['foo' => 'bar', 'baz' => 42];
        $template = new testStorage();

        $this->assertSame("Foo by storage: bar; Baz by storage: 42", (new NativeRenderer)->render($template, $data));

        $data = new Std(['foo' => 'bla', 'baz' => 13]);
        $template = new testStorage();

        $this->assertSame("Foo by storage: bla; Baz by storage: 13", (new NativeRenderer)->render($template, $data));
    }

    public function testNotBindThis()
    {
        $template = new testStorageWithoutThis();
        $this->assertSame("Class: " . NativeRenderer::class . ";", (new NativeRenderer)->render($template));

        $template = new File(__DIR__ . '/this.notbind.template.php');
        $this->assertSame("Class: " . NativeRenderer::class . ";", (new NativeRenderer)->render($template));
    }

    public function testRenderWithBindThis()
    {
        $obj = new class {
            protected $foo = 'bar';
            public $baz = 42;
        };

        $template = new testStorageWithThis();
        $this->assertSame("Foo by this: bar; Baz by this: 42;", (new NativeRenderer)->render($template, ['this' => $obj]));

        $template = new File(__DIR__ . '/this.bind.template.php');
        $this->assertSame("Foo by this: bar; Baz by this: 42;", (new NativeRenderer)->render($template, ['this' => $obj]));
    }

}
