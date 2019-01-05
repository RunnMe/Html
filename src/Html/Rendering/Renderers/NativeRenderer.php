<?php

namespace Runn\Html\Rendering\Renderers;

use Runn\Fs\File;
use Runn\Html\Rendering\RendererInterface;
use Runn\Storages\SingleValueStorageInterface;

/**
 * Native (PHP) template renderer
 *
 * Class NativeRenderer
 * @package Runn\Html\Rendering\Renderers
 */
class NativeRenderer
    implements RendererInterface
{

    /**
     * @param \Runn\Storages\SingleValueStorageInterface $template
     * @param iterable|null $data
     * @return string
     */
    public function render(SingleValueStorageInterface $template, iterable $data = null): string
    {
        $rendering = function ($data) use ($template) {

            if (null !== $data) {
                foreach ($data as $key => $val) {
                    $$key = $val;
                }
            }

            ob_start();

            if (($template instanceof File) && $template->isReadable()) {
                @include $template->getPath();
            } else {
                $template->load();
                eval("?>" . $template->get() . "<?php ");
            }

            $contents = ob_get_contents();
            ob_end_clean();

            return $contents;

        };

        if (isset($data['this']) && is_object($data['this'])) {
            $rendering = $rendering->bindTo($data['this'], get_class($data['this']));
            unset($data['this']);
        }

        return $rendering($data);
    }

}
