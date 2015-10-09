<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'My Account';
//$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'first_name',
            'last_name',
            'email:email',
            'skype',
            'phone',
        ],
    ]) ?>

    <p>
        <?= Html::a('Update data', [Url::toRoute('user/update-data')], ['class' => 'btn btn-primary']) ?>

        <?= Html::a('Change password', [Url::toRoute('user/change-password')], ['class' => 'btn btn-success'])?>

        <?= Html::a('Delete account', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>

        <?= Html::a('Create Advert', [Url::toRoute('advert/create')], ['class' => 'btn btn-warning']) ?>

        <?= Html::a('My Adverts',
            [Url::toRoute('advert/my-adverts')],
            ['class' => 'btn btn-info']) ?>

        <?= Html::a('My Bookmarks', [Url::toRoute('advert/bookmarks')], ['class' => 'btn btn-info'])?>


    </p>
</div>
