<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bookmark".
 *
 * @property integer $user_id
 * @property integer $advert_id
 *
 * @property Advert $advert
 * @property User $user
 */
class Bookmark extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bookmark';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'advert_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'advert_id' => 'Advert ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdvert()
    {
        return $this->hasOne(Advert::className(), ['id' => 'advert_id']);
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id'])->via('advert');
    }

    public function getSubcategory()
    {
        return $this->hasOne(Subcategory::className(), ['id' => 'subcategory_id'])->via('advert');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getBookmarks()
    {
        $bookmarks = Yii::$app->db->createCommand('SELECT
                          category.name AS category,
                          subcategory.name AS subcategory,
                          advert.title,
                          advert.updated_at
		                  FROM category, subcategory, advert, bookmark
                          WHERE bookmark.user_id = :user_id
        	                AND bookmark.advert_id = advert.id
                            AND category.id = advert.category_id
                            AND subcategory.id = advert.subcategory_id',
            [':user_id' => Yii::$app->user->identity->getId()])
            ->queryAll();

        return $bookmarks;
    }

    public function addToBookmarks($user_id, $advert_id)
    {
        //$user_id = Yii::$app->user->identity->getId();
        $command = 'INSERT INTO bookmark (user_id, advert_id) VALUES ' . $user_id . ', ' . $advert_id;
        Yii::$app->db->createCommand($command);
    }
}
