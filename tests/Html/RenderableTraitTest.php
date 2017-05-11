<?php

namespace Runn\tests\Html\RenderableTrait;

use Runn\Html\RenderableInterface;
use Runn\Html\RenderableTrait;

class RenderableTraitTest extends \PHPUnit_Framework_TestCase
{

    public function testGetTemplatePath()
    {
        $obj = new class implements RenderableInterface {
            use RenderableTrait;
        };
        $this->assertSame(__DIR__ . '/' . basename(__FILE__, '.php') . '.template.html', $obj->getTemplatePath());
    }

    public function testEmptyTemplate()
    {
        $obj = new class implements RenderableInterface {
            use RenderableTrait;
            public function getTemplatePath()/*: ?string*/
            {
                return '';
            }
        };
        $this->assertSame('', $obj->render());
    }

    public function testTemplate()
    {
        $filename = sys_get_temp_dir() . '/FsTest_save.php';
        file_put_contents($filename, 'Render: <?php echo $this->foo; ?>');

        $obj = new class implements RenderableInterface {
            protected $foo = 'test';
            use RenderableTrait;
        };
        $this->assertSame('Render: test', $obj->render($filename));

        unlink($filename);
    }

    public function testGetTemplate()
    {
        $filename = sys_get_temp_dir() . '/FsTest_save.php';
        file_put_contents($filename, 'Render by get template: <?php echo $this->foo; ?>');

        $obj = new class($filename) implements RenderableInterface {
            protected $template = null;
            public function __construct($template)
            {
                $this->template = $template;
            }
            public function getTemplatePath()/*: ?string*/
            {
                return $this->template;
            }
            protected $foo = 'test';
            use RenderableTrait;
        };
        $this->assertSame('Render by get template: test', $obj->render());

        unlink($filename);
    }

}