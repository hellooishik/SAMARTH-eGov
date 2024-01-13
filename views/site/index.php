<?php
use yii\helpers\Html;

$this->title = "Coral Grid Preparation";
?>

<div class="site-index">
    <?php if(Yii::$app->user->isGuest): ?>
        <div class="alert alert-dismissible alert-info">Hi SAMARTH
            <p>Please login to view inventory data. Username : Admin; Password : admin</p>
            <style>
                .alert-info {
                    color: #0c5460;
                    background-color: #d1ecf1;
                    border-color: #bee5eb;
                    position: relative;
                }

                .alert-info p {
                    margin-bottom: 0;
                }

                .alert-info .close {
                    position: absolute;
                    top: 0;
                    right: 0;
                    padding: 0.75rem 1.25rem;
                    color: inherit;
                }
            </style>
        </div>
    <?php else: ?>
        <?php if(Yii::$app->session->hasFlash('message')): ?>
            <div class="alert alert-dismissible alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?= Yii::$app->session->getFlash('message') ?>
            </div>
        <?php elseif(Yii::$app->session->hasFlash('success')): ?>
            <div class="alert alert-success">
                <?= Yii::$app->session->getFlash('success') ?>
            </div>
        <?php endif; ?>

        <div class="jumbotron">
            <h1 class="text-center text-primary">SAMARTH eGov Inventory</h1>
        </div>

        <div class="row">
            <div class="col-md-12">
                <?= Html::a('Create', ['site/create'], ['class' => 'btn btn-success']) ?>
            </div>
        </div>

        <div class="body-content">
            <div class="row">
                <table class="table table-hover table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Title</th>
                            <th scope="col">Details</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($posts) > 0): ?>
                            <?php foreach($posts as $post): ?>
                                <tr>
                                    <th scope="row"><?= $post->ID; ?></th>
                                    <td>
                                        <?= Html::a(Html::encode($post->Title), 'javascript:void(0);', [
                                            'class' => 'btn btn-link toggle-details',
                                            'data-post-id' => $post->ID,
                                        ]); ?>
                                    </td>
                                    <td class="details" style="display: none;">
                                        <?= Html::encode($post->details); ?>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <?= Html::a('View', ['view', 'id' => $post->ID], ['class' => 'btn btn-info']) ?>
                                            <?= Html::a('Update', ['update', 'id' => $post->ID], ['class' => 'btn btn-warning']) ?>
                                            <?= Html::a('Delete', ['delete', 'id' => $post->ID], [
                                                'class' => 'btn btn-danger',
                                                'data' => [
                                                    'confirm' => 'Are you sure you want to delete this item?',
                                                    'method' => 'post'
                                                ],
                                            ]) ?>
                                            <?= Html::a('Fetch', ['api', 'id' => $post->ID], [
                                                'class' => 'btn btn-primary fetch-details',
                                                'data-post-id' => $post->ID,
                                            ]) ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>
</div>

<script>
    // Add this JavaScript code to handle the toggle functionality
    document.addEventListener('DOMContentLoaded', function () {
        document.addEventListener('click', function (event) {
            if (event.target.classList.contains('toggle-details')) {
                const postId = event.target.getAttribute('data-post-id');
                const detailsElement = document.querySelector('.details[data-post-id="' + postId + '"]');
                detailsElement.style.display = detailsElement.style.display === 'none' ? 'table-cell' : 'none';
            }

            if (event.target.classList.contains('fetch-details')) {
                const postId = event.target.getAttribute('data-post-id');
                // Implement fetching logic here
                alert('Fetching details for post with ID: ' + postId);
            }
        });
    });
</script>
