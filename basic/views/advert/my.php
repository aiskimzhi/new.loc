<?php

use app\models\Region;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use app\models\Advert;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AdvertCRUD */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'My Adverts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="advert-my">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

 <!--   <p>
        <?= Html::a('Create Advert', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
-->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'showOnEmpty' => false,
        'columns' => [
            [
                'attribute' => 'region_id',
                //'value' => 'region.name',
                //'label' => 'Region',
                'format' => 'raw',
                'filter'=> $regions,
                'value' => function ($model) {
                    $text = '<div><strong><a href="' . Url::toRoute('advert/view?id=') . $model->id . '"> ' . $model->title . '</a></strong></div>';
                    $text .= '<div>' . $model->category->name . ' >> ' . $model->subcategory->name . '</div>';
                    $text .= '<br>';
                    $format = 'd M Y H:i';
                    $text .= date($format, $model->updated_at);
                    return $text;
                },
            ],
            [
                'attribute' => 'city_id',
                //'value' => 'city.name',
                //'label' => 'City',
                'filter'=> Advert::getCities(),
            ],
        ]
    ]) ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => [
            'class' => 'table',
        ],
        'showHeader' => false,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'user_id',
//            [
//                'attribute' => 'region_id',
//                'value' => 'region.name',
//                'label' => 'Region',
//                'filter'=> Advert::getAllIRegions(),
//            ],
//            //'city_id',
//            [
//                'attribute' => 'city_id',
//                'value' => 'city.name',
//                'label' => 'City',
//                'filter'=> Advert::getCities(),
//            ],
//            [
//                'attribute' => 'category_id',
//                'value' => 'category.name',
//                'label' => 'Category',
//                'filter'=> Advert::getAllICategories(),
//            ],
//            //'subcategory_id',
//            [
//                'attribute' => 'subcategory_id',
//                'value' => 'subcategory.name',
//                'label' => 'Subcategory',
//                'filter'=> Advert::getAllISubcategories(),
//            ],
//            'title',
//            'text:ntext',
//            'created_at',
            'user_id',
            [
                'attribute' => 'user_id',
                'label' => ''
            ],
            [
                'label' => 'content',
                'format' => 'html',
                'value' => function ($model) {
                    $text = '<div><strong><a href="' . Url::toRoute('advert/view?id=') . $model->id . '"> ' . $model->title . '</a></strong></div>';
                    $text .= '<div>' . $model->category->name . ' >> ' . $model->subcategory->name . '</div>';
                    $text .= '<br>';
                    $format = 'd M Y H:i';
                    $text .= date($format, $model->updated_at);
                    return $text;
                },
            ],
            'price',
//            [
//                'attribute' => 'updated_at',
//                'format' => ['date', 'php:d M Y, H:i']
//            ],
            'views',

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php
    $adv = new Advert();
    echo '<pre>';
    print_r($adv->getCities());
    ?>

</div>

<?php
/**
 * <!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<?php $this->title = 'My Adverts'?>
</head>
<body>
<div class="grid-view">
<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$format = 'd M Y H:i';
//    Yii::$app->db->createCommand('INSERT INTO advert (user_id, region_id, city_id, category_id, subcategory_id, title,
//    text, created_at, updated_at) VALUES (12, 1, 1, 1, 1, "title here", "text here", :created, :updated)',
//                                [
//                                    ':created' => time(),
//                                    ':updated' => time()
//                                ])->execute();

$model = new \app\models\Advert();
$array = $model->getMyAdverts();

?>
<h1><?= Html::encode($this->title) ?></h1>
<p><?= Html::a('Create Advert', ['create'], ['class' => 'btn btn-success']) ?></p>
<div>
<?php
$msg = 'Showing <b>1- </b> of <b>' . count($array) . '</b> items.';
echo $msg;
?>
</div>
<?php
$form = ActiveForm::begin(['id' => 'search-form']);

$region = $form->field($model, 'region_id')->dropDownList($regionList,
[
'prompt'   => '- Choose a Region -',
'onchange' => '
$.ajax({
url: "' . Url::toRoute('get-city?id=') . '" + $(this).val(),
success: function( data ) {
$( "#' . Html::getInputId($model, 'city_id') . '" ).html( data ).attr("disabled", false);
}
});
'
]);

$city = $form->field($model, 'city_id')
->dropDownList(
['id' => '- Choose a City -'],
[ 'disabled' => 'disabled']
);


$category = $form->field($model, 'category_id')->dropDownList($catList,
[
'prompt'   => '- Choose a Category -',
'onchange' => '
$.ajax({
url: "' . Url::toRoute('get-subcat?id=') . '" + $(this).val(),
success: function( data ) {
$( "#' . Html::getInputId($model, 'subcategory_id') . '" ).html( data ).attr("disabled", false);
}
});
'
]);

$subcateory = $form->field($model, 'subcategory_id')
->dropDownList(
['id' => '- Choose a Sub-category -'],
[ 'disabled' => 'disabled']
);

$title = $form->field($model, 'title')->textInput();
?>
<?php $table = '<table class="table table-striped table-bordered">'; ?>
<?php $table .= '<tr>
<th>Region</th>
<th>City</th>
<th>Category</th>
<th>Subcategory</th>
<th>Title</th>
<th>Updated At</th>
<th>Views</th>
<th>Edit</th>
</tr>'; ?>

<?php
$table .= '<tr><td>' . $region . '</td>';
$table .= '<td>' . $city . '</td>';
$table .= '<td>' . $category . '</td>';
$table .= '<td>' . $subcateory . '</td>';
$table .= '<td>' . $title . '</td></tr>';

?>

<?php for ($tr = 0; $tr < count($array); $tr++) : ?>
<?php $table .= '<tr>';?>
<?php $table .= '<td>' . $array[$tr]['region'] . '</td>'; ?>
<?php $table .= '<td>' . $array[$tr]['city'] . '</td>'; ?>
<?php $table .= '<td>' . $array[$tr]['category'] . '</td>'; ?>
<?php $table .= '<td>' . $array[$tr]['subcategory'] . '</td>'; ?>
<?php $table .= '<td>' . $array[$tr]['title'] . '</td>'; ?>
<?php $table .= '<td>' . date($format, $array[$tr]['updated_at']) .'</td>'; ?>
<?php $table .= '<td>' . $array[$tr]['views'] .'</td>'; ?>
<?php $table .= '<td><a href="http://vk.com" title="View" aria-label="View" data-pjax="0">
<span class="glyphicon glyphicon-eye-open"></span></a>
<a title="Update" aria-label="Update" data-pjax="0">
<span class="glyphicon glyphicon-pencil"></span></a>
<a title="Delete" aria-label="Delete" data-confirm="Are you sure you want to delete this item?" data-method="post" data-pjax="0">
<span class="glyphicon glyphicon-trash"></span></a>
</td>'; ?>
<?php $table .= '</tr>'; ?>
<?php endfor; ?>
<?php $table .= '</table>'; ?>
<?= $table ?>

<?php ActiveForm::end(); ?>
</div>


</body>
</html>



CONTROLLER

$model = new Advert();

$catList = ArrayHelper::map(Category::find()->asArray()->all(), 'id', 'name');
$subcatList = ArrayHelper::map(Subcategory::find()->asArray()->all(), 'id', 'name');
$regionList = ArrayHelper::map(Region::find()->asArray()->all(), 'id', 'name');
$cityList = ArrayHelper::map(City::find()->asArray()->all(), 'id', 'name');

return $this->render('my',
[
'model' => $model,
'catList' => $catList,
'subcatList' => $subcatList,
'regionList' => $regionList,
'cityList' => $cityList
]);
 */
