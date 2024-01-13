<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'About';

?>
<div class="site-about">
<div class="body-content">
        <h1><?= Html::encode($post->Title) ?></h1>

        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <strong>Categories:</strong>
                <span class="badge bg-primary rounded-pill"><?= Html::encode($post->categories) ?></span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <strong>Details:</strong>
                <span class="badge bg-primary rounded-pill"><?= Html::encode($post->details) ?></span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <strong>Price:</strong>
                <span class="badge bg-primary rounded-pill"><?= Html::encode($post->price) ?></span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <strong>Supplier:</strong>
                <span class="badge bg-primary rounded-pill"><?= Html::encode($post->supplier) ?></span>
            </li>
        </ul>

        <div class="row mt-3">
            <a href="<?= yii::$app->homeUrl ?>" class="btn btn-primary">Go back</a>
        </div>
    </div>
</div>
