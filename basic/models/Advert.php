<?php

namespace app\models;

use Yii;
use yii\db\Query;


/**
 * This is the model class for table "advert".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $region_id
 * @property integer $city_id
 * @property integer $category_id
 * @property integer $subcategory_id
 * @property string $title
 * @property string $text
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $views
 *
 * @property Category $category
 * @property City $city
 * @property Region $region
 * @property Subcategory $subcategory
 * @property User $user
 * @property Bookmark[] $bookmarks
 */
class Advert extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'advert';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['region_id', 'city_id', 'category_id', 'subcategory_id', 'title', 'text'], 'required'],
            //[['created_at', 'updated_at', 'views'], 'integer'],
            [['text'], 'string'],
            [['title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'region_id' => 'Region',
            'city_id' => 'City',
            'category_id' => 'Category',
            'subcategory_id' => 'Subcategory',
            'title' => 'Title',
            'text' => 'Text',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(Region::className(), ['id' => 'region_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubcategory()
    {
        return $this->hasOne(Subcategory::className(), ['id' => 'subcategory_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookmarks()
    {
        return $this->hasMany(Bookmark::className(), ['advert_id' => 'id']);
    }

    public function getMyAdvert()
    {
        $adv = Yii::$app->db->createCommand('SELECT
                    advert.id,
                    category.name AS category,
                    subcategory.name AS subcategory,
                    region.name AS region,
                    city.name AS city,
                    advert.title,
                    advert.created_at,
                    advert.updated_at,
                    advert.views
                      FROM category, subcategory, region, city, advert
                      WHERE category.id = advert.category_id
                        AND subcategory.id = advert.subcategory_id
                        AND region.id = advert.region_id
                        AND city.id = advert.city_id
                        AND advert.user_id = :user_id',
            [':user_id' => Yii::$app->user->identity->getId()])
            ->queryAll();

        return $adv;
    }

    public function createAdvert()
    {
        if ($this->validate()) {
            $advert = new Advert;
            $advert->user_id = Yii::$app->user->identity->getId();
            $advert->category_id = $this->category_id;
            $advert->subcategory_id = $this->subcategory_id;
            $advert->region_id = $this->region_id;
            $advert->city_id = $this->city_id;
            $advert->title = $this->title;
            $advert->text = $this->text;
            $advert->created_at = time();
            $advert->updated_at = time();
            if ($advert->save()) {
                return $advert;
            }
        }
        return null;
    }
}
