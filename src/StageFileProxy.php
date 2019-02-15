<?php
/**
 * Stage File Proxy plugin for Craft CMS 3.x
 *
 * Stage File Proxy is a general solution for getting production files on a development server on demand.
 *
 * @link      liftov.be
 * @copyright Copyright (c) 2019 Wouter Van Scharen
 */

namespace liftov\stagefileproxy;

use Craft;
use craft\base\Plugin;
use craft\events\GetAssetUrlEvent;
use craft\services\Assets;

use yii\base\Event;

/**
 * Class StageFileProxy
 *
 * @author    Wouter Van Scharen
 * @package   StageFileProxy
 * @since     1.0.0
 *
 */
class StageFileProxy extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var StageFileProxy
     */
    public static $plugin;

    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $schemaVersion = '1.0.0';

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        Event::on(
            Assets::class,
            Assets::EVENT_GET_ASSET_URL,
            function (GetAssetUrlEvent $event) {
                $remoteSource = env("STAGE_FILE_PROXY_REMOTE");

                if ($remoteSource) {
                    $filename = $event->asset->filename;
                    $fileDirectory = 'files/' . $event->asset->getFolder()->path;
                    $localeFilePath = $fileDirectory . $filename;

                    if (!file_exists($localeFilePath)) {
                        if (!file_exists($fileDirectory)) {
                            mkdir($fileDirectory, 0775, true);
                        }

                        $remoteFilePath = $remoteSource . $localeFilePath;

                        file_put_contents($localeFilePath, fopen($remoteFilePath, 'r'));
                    }
                }
            },
            null,
            false
        );

        Craft::info(
            Craft::t(
                'stage-file-proxy',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }
}
