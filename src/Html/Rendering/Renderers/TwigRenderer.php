<?php

namespace Runn\Html\Rendering\Renderers;

use Runn\Core\ArrayCastingInterface;
use Runn\Fs\File;
use Runn\Html\Rendering\RendererInterface;
use Runn\Storages\SingleValueStorageInterface;

/**
 * Twig templates renderer
 *
 * Class TwigRenderer
 * @package Runn\Html\Rendering\Renderers
 */
class TwigRenderer
    implements RendererInterface
{

    /**
     * @param \Runn\Storages\SingleValueStorageInterface $template
     * @param iterable|null $data
     * @return string
     */
    public function render(SingleValueStorageInterface $template, iterable $data = null): string
    {
        if ($data instanceof ArrayCastingInterface) {
            $data = $data->toArrayRecursive();
        }

        if (($template instanceof File) && $template->isReadable()) {
            $loader = new \Twig\Loader\FilesystemLoader(dirname($template->getPath()));
            $twig = new \Twig\Environment($loader);
            return $twig->render(basename($template->getPath()), $data);
        } else {
            $template->load();
            $loader = new \Twig\Loader\ArrayLoader([
                'index' => $template->get()
            ]);
            $twig = new \Twig\Environment($loader);
            return $twig->render('index', $data);
        }
    }

}
