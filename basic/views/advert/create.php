<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Advert */

$this->title = 'Create Advert';
//$this->params['breadcrumbs'][] = ['label' => 'Adverts', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;

use yii\bootstrap\ActiveForm;
//use yii\helpers\Html;
use yii\helpers\Url;


$form = ActiveForm::begin(['id' => 'login-form']);

echo $form->field($model, 'category_id')->dropDownList($catList,
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


echo $form->field($model, 'subcategory_id')
    ->dropDownList(
        ['id' => '- Choose a Sub-category -'],
        [ 'disabled' => 'disabled']
    );

echo $form->field($model, 'region_id')->dropDownList($regionList,
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


echo $form->field($model, 'city_id')
    ->dropDownList(
        ['id' => '- Choose a City -'],
        [ 'disabled' => 'disabled']
    );

echo $form->field($model, 'title')->textInput();

echo $form->field($model, 'text')->textarea(['rows' => 6]);

echo '<div class="form-group">' . Html::submitButton('Create Advert', ['class' => 'btn btn-success']) . '</div>';

ActiveForm::end();