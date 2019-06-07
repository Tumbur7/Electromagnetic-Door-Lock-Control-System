<?php
namespace ramosisw\CImaterial\web;

use yii\base\Exception;
use yii\web\AssetBundle as BaseMaterialAsset;

/**
 * Material AssetBundle
 * @since 0.1
 */
class MaterialAsset extends BaseMaterialAsset
{
    public $sourcePath = '@vendor/ramosisw/yii2-material-dashboard/assets';


    public $css = [
        'css/material-dashboard.css',
        'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css',
        'http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons',
    ];

    public $js = [
        'js/material.min.js',
        'js/chartist.min.js',
        'js/bootstrap-notify.js',
        'js/material-dashboard.js',
        'js/superfish.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];


    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
    }
}
