<?php

namespace mutation\assetsmanifest\variables;

use mutation\assetsmanifest\AssetsManifestPlugin;
use mutation\assetsmanifest\models\SettingsModel;

class AssetsVariable
{
    public function version()
    {
        /** @var SettingsModel $settings */
        $settings = AssetsManifestPlugin::$plugin->getSettings();

        $manifestPath = $this->normalizePath(CRAFT_BASE_PATH . '/' . $settings->manifestPath);
        $manifest = file_get_contents($manifestPath);
        $json = json_decode($manifest, true);
        return $json['version'];
    }

    private function normalizePath($path)
    {
        return rtrim(preg_replace('~/+~', DIRECTORY_SEPARATOR, $path), DIRECTORY_SEPARATOR);
    }
}
