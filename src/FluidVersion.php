<?php

namespace Klxm\FluidDemo;

use Composer\InstalledVersions;
use Klxm\Fluid\Editing;
use Klxm\Fluid\FluidAddon;
use Redaxo\Core\Core;
use Redaxo\Core\ExtensionPoint\Extension;
use Redaxo\Core\ExtensionPoint\ExtensionLevel;
use Redaxo\Core\ExtensionPoint\ExtensionPoint;

use function file;
use function is_file;
use function preg_match;
use function str_contains;
use function str_replace;

use const FILE_IGNORE_NEW_LINES;

/**
 * Release of fluid for the demo content: `{fluid-version}` in the output becomes e.g. `1.0.0-beta.12`.
 *
 * Composer only knows the branch (`1.x-dev`) when fluid is installed from a path repository, so the first heading of
 * fluid's CHANGELOG is used then. The token stays in editing mode, so saving a text keeps it.
 *
 * @internal
 */
final class FluidVersion
{
    public const string TOKEN = '{fluid-version}';

    public static function boot(): void
    {
        if (!Core::isFrontend()) {
            return;
        }
        Extension::register('OUTPUT_FILTER', static function (ExtensionPoint $ep): string {
            $html = (string) $ep->subject;
            if (!str_contains($html, self::TOKEN) || Editing::requested()) {
                return $html;
            }

            return str_replace(self::TOKEN, self::get(), $html);
        }, ExtensionLevel::Early);
    }

    public static function get(): string
    {
        $version = InstalledVersions::getPrettyVersion('klxm/fluid') ?? '';
        if (1 === preg_match('/^v?\d+\.\d+\.\d+/', $version)) {
            return $version;
        }
        $changelog = FluidAddon::instance()->getPath('CHANGELOG.md');
        foreach (is_file($changelog) ? (array) file($changelog, FILE_IGNORE_NEW_LINES) : [] as $line) {
            if (1 === preg_match('/^## (\d+\.\d+\.\d+\S*)/', (string) $line, $m)) {
                return $m[1];
            }
        }

        return $version;
    }
}
