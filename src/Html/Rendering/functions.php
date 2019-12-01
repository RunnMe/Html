<?php

namespace Runn\Html\Rendering;

/**
 * Escapes string for HTML context
 *
 * @param string $contents
 * @return string
 */
function escape(string $contents): string
{
    return htmlspecialchars($contents, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5, 'UTF-8');
}
