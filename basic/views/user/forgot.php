<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$form = ActiveForm::begin();
echo Html::input('text', 'email');
echo Html::input('submit', 'submit', 'change');
ActiveForm::end();
echo 'Ha-ha';