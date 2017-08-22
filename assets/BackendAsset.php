<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Christoph Rohrmoser
 * @since 2.0
 */
class BackendAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/backend.css',
    ];
    public $js = [
        'js/index.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
