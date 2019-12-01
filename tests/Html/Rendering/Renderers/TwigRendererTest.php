<?php

namespace Runn\tests\Html\Rendering\Renderers\TwigRenderer;

use PHPUnit\Framework\TestCase;
use Runn\Core\Std;
use Runn\Fs\File;
use Runn\Html\Rendering\Renderers\TwigRenderer;
use Runn\Storages\SingleValueStorageInterface;

class testStorage implements SingleValueStorageInterface
{
    public function load() {}
    public function save() {}
    public function get() {
        return 'Foo by storage: {{ foo }}; Baz by storage: {{ baz }}';
    }
    public function set($value) {}
}

class TwigRendererTest extends TestCase
{

    public function testRenderByFile()
    {
        $data = ['foo' => 'bar', 'baz' => 42];
        $template = new File(__DIR__ . '/twig.template.twig');

        $this->assertSame("Foo: bar; Baz: 42", (new TwigRenderer)->render($template, $data));

        $data = new Std(['foo' => 'bla', 'baz' => 13]);
        $template = new File(__DIR__ . '/twig.template.twig');

        $this->assertSame("Foo: bla; Baz: 13", (new TwigRenderer)->render($template, $data));
    }

    public function testRenderByStorage()
    {
        $data = ['foo' => 'bar', 'baz' => 42];
        $template = new testStorage();

        $this->assertSame("Foo by storage: bar; Baz by storage: 42", (new TwigRenderer)->render($template, $data));

        $data = new Std(['foo' => 'bla', 'baz' => 13]);
        $template = new testStorage();

        $this->assertSame("Foo by storage: bla; Baz by storage: 13", (new TwigRenderer)->render($template, $data));
    }

}
