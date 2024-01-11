<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm; 

$this->title = "Coral Crud Application";
?>

<div class="site-index"> 
    <h1>Create Your New Post</h1>
    <div class="body-content">
        <?php $form = ActiveForm::begin() ?>
        <div class="row">
            <div class="form-group">
                <div class="col-lg-6">
                    <?= $form->field($post, 'Title') ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-6">
                <?php $items = ['e-commerce' => 'e-commerce', 'CMS' => 'CMS', 'MVC' => 'MVC']; ?>
                    <?= $form->field($post, 'categories')->dropDownList($items, ['prompt' => 'Select']) ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-6">
                    <?= $form->field($post, 'details')->textarea(['rows' => '6']) ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-6">
                    <?= $form->field($post, 'price') ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-6">
                    <?= $form->field($post, 'supplier') ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-6 col-lg-offset-3"> <!-- Corrected the nested col-lg-3 -->
                    <?= Html::submitButton('Create Post', ['class' => 'btn btn-primary']) ?> <!-- Corrected the class attribute -->
                </div>
            </div>
        </div>
        <?php ActiveForm::end() ?>
    </div>
</div>
