<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\grid\ActionColumn;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BookmarkSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bookmarks';
//$this->params['breadcrumbs'][] = $this->title;
?>

<div class="bookmark-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
    $n = Yii::$app->request->get();
    var_dump($n);
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'advert.category.name',
                'label' => 'Category',
//                'value' => 'category.name',
//                'filter'
            ],
            [
                'attribute' => 'advert.subcategory.name',
                'label' => 'Subcategory',
//                'value' => 'subcategory.name',
//                'filter'
            ],
            [
//                'attribute',
                'label' => 'Title',
                'value' => 'advert.title',
            ],
            'advert.updated_at:datetime',

//            'id',
            'user_id',
            'advert_id',

//            ['class' => 'yii\grid\ActionColumn']

            [
                'class' => ActionColumn::className(),
                'template' => '{view} {delete}',
                'buttons' => [
                    'view' => function($url, $model, $key) {
                        $url = Url::toRoute('advert/view') . '?id=' . $model->advert_id;
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                            'title' => 'View',
                            'data-method' => 'post',
                            'data-pjax' => 0
                        ]);
                    },
                    'delete' => function($url, $model, $key) {
                        $url = Url::toRoute('advert/delete') . '?id=' . $model->advert_id;
                        return  Html::a('<span class="glyphicon glyphicon-remove"></span>', $url, [
                            'title' => 'Delete',
                            'data-confirm' => 'Are you sure you want to delete?',
                            'data-method' => 'post',
                            'data-pjax' => 0
                        ]);
                    }
                ]
            ]
        ],
    ]); ?>

</div>
