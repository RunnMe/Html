<?php

namespace Runn\tests\Html\Form\Fields\SelectField;

use PHPUnit\Framework\TestCase;
use Runn\Core\Std;
use Runn\Fs\File;
use Runn\Html\Form\Fields\SelectField;
use Runn\Html\Rendering\RenderableInterface;

class SelectFieldTest extends TestCase
{

    public function testRenderWoOptions()
    {
        $field = new SelectField();
        $this->assertInstanceOf(RenderableInterface::class, $field);
        $this->assertSame('<select></select>', $field->render());

        $field = new SelectField('foo');
        $this->assertSame('<select name="foo"></select>', $field->render());

        $field = new SelectField('foo', 42);
        $this->assertSame('<select name="foo"></select>', $field->render());

        $field = new SelectField('foo', 42, ['class'=>'test']);
        $this->assertSame('<select class="test" name="foo"></select>', $field->render());
    }

    public function testRenderWOptions()
    {
        $field = (new SelectField())->values([1 => 'foo', 2 => 'bar']);
        $this->assertSame("<select>\n<option value=\"1\">foo</option>\n<option value=\"2\">bar</option>\n</select>", $field->render());

        $field = (new SelectField())->values(new Std([1 => 'foo', 2 => 'bar']));
        $this->assertSame("<select>\n<option value=\"1\">foo</option>\n<option value=\"2\">bar</option>\n</select>", $field->render());

        $field = (new SelectField('test', 'bar'))->values([1 => 'foo', 2 => 'bar']);
        $this->assertSame("<select name=\"test\">\n<option value=\"1\">foo</option>\n<option value=\"2\" selected>bar</option>\n</select>", $field->render());
    }

    public function testRenderTemplate()
    {
        $filename = sys_get_temp_dir() . '/FsTest_save.php';
        file_put_contents($filename, 'Render: <?php echo $this->getName(); ?>=<?php echo $this->getValue(); ?>');

        $field = new SelectField('foo', 42);
        $this->assertSame('Render: foo=42', $field->render(new File($filename)));

        unlink($filename);
    }

}
