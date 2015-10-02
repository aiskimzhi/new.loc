<?php

use yii\helpers\Html;
use yii\grid\GridView;

GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'id',
        'first_name',
        'last_name',
        'password',
        'email:email',
        'skype',
        'phone',
        // 'auth_key',
        // 'password_reset_token',

        ['class' => 'yii\grid\ActionColumn'],
    ],
]);