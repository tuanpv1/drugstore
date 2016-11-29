<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/components.css',
        'css/icons.css',
        'css/responsee.css',
        'owl-carousel/owl.carousel.css',
        'owl-carousel/owl.theme.css',
        'css/template-style.css',
        'http://fonts.googleapis.com/css?family=Open+Sans:400,300,700,800&subset=latin,latin-ext',
        'css/site.css',
    ];
    public $js = [
        'js/jquery-1.8.3.min.js',
        'js/jquery-ui.min.js',
        'js/tp.js',
        'js/responsee.js',
        'owl-carousel/owl.carousel.js',
        'js/template-scripts.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];
}
