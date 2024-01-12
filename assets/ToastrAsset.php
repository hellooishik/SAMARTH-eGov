<?php

namespace app\assets;

use yii\web\AssetBundle;

class ToastrAsset extends AssetBundle
{
    public $sourcePath = '@bower/toastr'; // Assuming you have installed Toastr via Bower
    public $css = [
        'toastr.min.css',
    ];
    public $js = [
        'toastr.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
