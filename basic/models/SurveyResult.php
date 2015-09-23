<?php

namespace app\models;

use Yii;
use yii\base\Model;

class SurveyResult extends Model
{
    public $category_id;
    public $sub_cat_id;
    public $region_id;
    public $city_id;
    public $title;
    public $text;

}