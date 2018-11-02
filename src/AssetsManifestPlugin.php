<?php

namespace mutation\assetsmanifest;

use craft\base\Plugin;
use craft\web\twig\variables\CraftVariable;
use mutation\assetsmanifest\variables\AssetsVariable;
use mutation\assetsmanifest\models\SettingsModel;
use yii\base\Event;

class AssetsManifestPlugin extends Plugin
{
    /**
     * @var AssetsManifestPlugin
     */
    public static $plugin;

    public function init()
    {
        parent::init();

        self::$plugin = $this;

        $this->initEvents();
    }

    protected function initEvents()
    {
        Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            function (Event $event) {
                /** @var CraftVariable $variable */
                $variable = $event->sender;
                $variable->set('assetsManifest', AssetsVariable::class);
            }
        );
    }

    protected function createSettingsModel()
    {
        return new SettingsModel();
    }
}
