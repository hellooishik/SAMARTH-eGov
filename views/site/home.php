<?php
use yii\helpers\Html;
$this->title = "Coral Grid Preparation"
?>

<div class="site-index">
    <div class="jumbotron">
        <h1>The Coral Grid Preparation</h1>
        <style>
            h1 {
                color: #3c8dbc !important;
                display: flex;
                justify-content: center;
            }
        </style>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?= Html::a('Create', ['site/create'], ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
    <div class="body-content">
        <div class="row">
            <table class="table table-hover">
            <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Title</th>
        <th scope="col">Categories</th>
        <th scope="col">Details</th>
        <th scope="col">Price</th>
        <th scope="col">Supplier</th>
        <th scope="col">Action</th>
    </tr>
</thead>
<tbody>
    <?php if(count($posts) > 0): ?>
        <?php foreach($posts as $post): ?>
            <tr class="table-active">
                <th scope="row"><?php echo $post->ID; ?></th>
                <td><?php echo $post->Title; ?></td>
                <td><?php echo $post->categories; ?></td>
                <td><?php echo $post->details; ?></td>
                <td><?php echo $post->price; ?></td>
                <td><?php echo $post->supplier; ?></td>
                <td>
                    <div class="btn-group">
                        <?= Html::a('View', ['your/view/action', 'id' => $post->ID], ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('Update', ['your/update/action', 'id' => $post->ID], ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('Delete', ['your/delete/action', 'id' => $post->ID], ['class' => 'btn btn-primary', 'data' => ['confirm' => 'Are you sure you want to delete this item?', 'method' => 'post']]) ?>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</tbody>
            </table>
        </div>
    </div>
</div>
