<?php

namespace mutation\assetsmanifest\variables;

use Exception;
use mutation\assetsmanifest\AssetsManifestPlugin;
use mutation\assetsmanifest\models\SettingsModel;

class AssetsVariable
{
    public function version()
    {
        /** @var SettingsModel $settings */
        $settings = AssetsManifestPlugin::$plugin->getSettings();

        $manifestPath = $this->normalizePath(CRAFT_BASE_PATH . '/' . $settings->manifestPath);
        try {
            $manifest = file_get_contents($manifestPath);

            if ($manifest) {
                $json = json_decode($manifest, true);
                return $json['version'];
            }
        } catch (Exception $e) {

        }

        return time();
    }

    private function normalizePath($path)
    {
        return rtrim(preg_replace('~/+~', DIRECTORY_SEPARATOR, $path), DIRECTORY_SEPARATOR);
    }
}
