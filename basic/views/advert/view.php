<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Advert */

$this->title = $model->title;
//$this->params['breadcrumbs'][] = ['label' => 'Adverts', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Region: ',
                'value' =>  $model->region->name
            ],
            [
                'label' => 'City: ',
                'value' => $model->city->name
            ],
            [
                'label' => 'Category: ',
                'value' => $model->category->name
            ],
            [
                'label' => 'Subcategory',
                'value' => $model->subcategory->name
            ],
            [
                'label' => 'Updated: ',
                'value' => $model->updated_at,
                'format' => ['date', 'php:d M Y, H:i']
            ],
            [
                'label' => $model->title,
                'value' => $model->text
            ],
            [
                'label' => 'Phone',
                'value' => $model->user->phone
            ]
        ]
    ]) ?>


    <?php

    $arr = $model->getAdvert($model->id);

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
        $model->countViews();

        $url = \yii\helpers\Url::toRoute('bookmark/add-to-bookmarks?id=') . $_GET['id'];
        echo Html::input('button', 'button', 'Add to Bookmarks', [
            'onclick' => '
                        $.ajax({
                            url: "' . $url . '",
                            success: function() {
                                alert("This advert was added to your bookmarks");
                            }
                        });
                        '
        ]);
    }
    ?>
</div>
