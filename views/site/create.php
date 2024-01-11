<?php
use yii\helpers\html;
use yii\widgets\ActiveForm; 
$this->title = "Coral Crud Application";
?>

<div class = "site-index"> 
    <h1>Create Your New Post
        <div class= "body-content">
            <?php
            $form = ActiveForm::begin()
            ?>
            <div class ="row">
                <div class="form-group">
                    <div class = "col-lg-6">
                        <?= $form -> field($post, 'Tittle')?>
                    </div>
                </div>
            </div>
            <?php ActiveForm::end()?>
        </div>
</div>