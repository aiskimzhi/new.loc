<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Advert */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Adverts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="advert-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
<!--
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'id',
            'user_id',
            'region_id',
            'city_id',
            'category_id',
            'subcategory_id',
            'title',
            'text:ntext',
            'created_at',
            'updated_at',
            'views',
        ],
    ]) ?>
-->

    <?php $arr = $model->getAdvert($model->id); ?>
    <?= 'Category: ' . $arr[0]['category'] . '<br>'; ?>
    <?= 'Subcategory: ' . $arr[0]['subcategory'] . '<br>'; ?>
    <?= 'Region: ' . $arr[0]['region'] . '<br>'; ?>
    <?= 'City: ' . $arr[0]['city'] . '<br>'; ?>
    <?= $arr[0]['title'] . '<br>'; ?>
    <?= $arr[0]['text'] . '<br>'; ?>
    <?= '<h5><b>Contacts:</b></h5>'; ?>
    <?= 'Phone: ' . $arr[0]['phone'] . '<br>'; ?>
    <?= 'Skype: ' . $arr[0]['skype'] . '<br>'; ?>
    <?= 'E-mail: ' . $arr[0]['email'] . '<br>'; ?>

    <?php

    if ($arr[0]['user_id'] == Yii::$app->user->identity->getId()) {
        echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
        echo Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]);
    } else {
        echo Html::a('Add to bookmarks', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
    }
    ?>
</div>
