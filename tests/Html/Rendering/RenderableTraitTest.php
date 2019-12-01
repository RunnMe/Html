<?php

namespace Runn\tests\Html\Rendering\RenderableTrait;

use PHPUnit\Framework\TestCase;
use Runn\Fs\File;
use Runn\Html\Rendering\RenderableInterface;
use Runn\Html\Rendering\RenderableTrait;
use Runn\Storages\SingleValueStorageInterface;
use Runn\tests\Html\Rendering\RenderableTraitTestEmptyTemplate;

class RenderableTraitTest extends TestCase
{

    public function testGetDefaultTemplateExists()
    {
        $obj = new class implements RenderableInterface {
            use RenderableTrait;
        };
        $this->assertInstanceOf(SingleValueStorageInterface::class, $obj->getDefaultTemplate());
        $this->assertInstanceOf(File::class, $obj->getDefaultTemplate());
        $this->assertEquals(new File(__DIR__ . '/' . basename(__FILE__, '.php') . '.template.php'), $obj->getDefaultTemplate());

        $this->assertSame('File template test!', $obj->render());
    }

    public function testGetDefaultTemplateNotExists()
    {
        require_once __DIR__ . '/RenderableTraitTestEmptyTemplate.php';
        $obj = new RenderableTraitTestEmptyTemplate();
        $this->assertNull($obj->getDefaultTemplate());
    }

    public function testGetTemplateNull()
    {
        $obj = new class implements RenderableInterface {
            use RenderableTrait;
        };
        $this->assertEquals($obj->getDefaultTemplate(), $obj->getTemplate());
        $this->assertEquals(new File(__DIR__ . '/' . basename(__FILE__, '.php') . '.template.php'), $obj->getTemplate());
    }

    public function testGetTemplateNotNull()
    {
        $filename = sys_get_temp_dir() . '/Renderable_Test_1.php';
        touch($filename);
        $template = new File($filename);

        $obj = new class implements RenderableInterface {
            use RenderableTrait;
        };
        $obj->setTemplate($template);

        $this->assertSame($template, $obj->getTemplate());

        unlink($filename);
    }

    public function testEmptyTemplate()
    {
        $obj = new class implements RenderableInterface {
            use RenderableTrait;
            public function getDefaultTemplate()
            {
                return null;
            }
        };
        $this->assertSame('', $obj->render());
    }

    public function testCustomTemplate()
    {
        $filename = sys_get_temp_dir() . '/Renderable_Test_2.php';
        file_put_contents($filename, 'Render: <?php echo $this->foo; ?>');

        $obj = new class implements RenderableInterface {
            protected $foo = 'test';
            use RenderableTrait;
        };
        $obj->setTemplate(new File($filename));
        $this->assertSame('Render: test', $obj->render());

        unlink($filename);
    }

}
