<?php

namespace Runn\Html\Renderers;

use Runn\Fs\File;
use Runn\Html\RendererInterface;
use Runn\Storages\SingleValueStorageInterface;

/**
 * Native (PHP) templates renderer
 *
 * Class NativeRenderer
 * @package Runn\HtmlRenderers
 */
class NativeRenderer
    implements RendererInterface
{

    /**
     * @param iterable $data
     * @param \Runn\Storages\SingleValueStorageInterface $template
     * @return string
     */
    public function render(/*iterable */$data, SingleValueStorageInterface $template): string
    {
        $rendering = function ($data) use ($template) {

            foreach ($data as $key => $val) {
                $$key = $val;
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

        if (isset($data['this'])) {
            if (is_object($data['this'])) {
                $rendering = $rendering->bindTo($data['this'], get_class($data['this']));
            }
            unset($data['this']);
        }

        return $rendering($data);

    }

}