<?php

use app\models\Advert;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AdvertCRUD */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Adverts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="advert-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Advert', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
//            'user_id',
            [
                'attribute' => 'region_id',
                'value' => 'region.name',
                'label' => 'Region',
                'filter'=> Advert::getAllRegions(),
            ],
            //'city_id',
            [
                'attribute' => 'city_id',
                'value' => 'city.name',
                'label' => 'City',
                'filter'=> Advert::getCities(),
            ],
            [
                'attribute' => 'category_id',
                'value' => 'category.name',
                'label' => 'Category',
                'filter'=> Advert::getAllICategories(),
            ],
            //'subcategory_id',
            [
                'attribute' => 'subcategory_id',
                'value' => 'subcategory.name',
                'label' => 'Subcategory',
                'filter'=> Advert::getSubcategories(),
            ],
            'title',
//            'text:ntext',
//            'created_at',
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:d M Y, H:i'],
//                'filter' => DatePicker::widget(
//                    [
//                        'model' => $searchModel,
//                        'attribute' => 'updated_at',
//                        'options' => ['class' => 'form-control'],
//                        'clientOptions' => ['dateFormat' => 'mm dd, yyyy']
//                    ]
//                )
            ],
            'views',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php
    $adv = new Advert();
    echo '<pre>';
    //print_r($dataProvider);
    ?>

</div>
