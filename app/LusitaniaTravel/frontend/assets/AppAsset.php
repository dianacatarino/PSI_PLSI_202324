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
        'css/site.css',
        'css/style.css',
        'css/bootstrap.css',
        'lib/owlcarousel/assets/owl.carousel.min.css',
        'lib/owlcarousel/assets/owl.theme.default.min.css',
        'lib/aos/aos.css',
        'lib/lightbox/css/lightbox.min.css',
        'lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css',
        'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css',
    ];
    public $js = [
        'js/bootstrap.js',
        'js/jquery-3.6.0.min.js',
        'js/jquery.mask.min.js',
        'js/script.js',
        'lib/owlcarousel/owl.carousel.min.js',
        'lib/aos/aos.js',
        'lib/lightbox/js/lightbox.min.js',
        'lib/tempusdominus/js/moment.min.js',
        'lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js',
        'lib/tempusdominus/js/moment-timezone.min.js',
        'lib/jquery/jquery.min.js',
        'lib/jquery/jquery-migrate.min.js',
        'lib/bootstrap/js/bootstrap.bundle.min.js',
        'lib/easing/easing.min.js',
        'lib/counterup/jquery.waypoints.min.js',
        'temlib/wow/wow.min.js',
        'lib/counterup/jquery.counterup.js',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js',
    ];
    public $logo = 'public/img/logo_horizontal.png';
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset',
    ];
}
