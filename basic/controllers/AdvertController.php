<?php

namespace app\controllers;

use app\models\AdvertUse;
use app\models\Bookmark;
use Yii;
use app\models\Advert;
use app\models\AdvertCRUD;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
use app\models\Region;
use app\models\City;
use app\models\Category;
use app\models\Subcategory;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;

/**
 * AdvertController implements the CRUD actions for Advert model.
 */
class AdvertController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Advert models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AdvertCRUD();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Advert model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = new Advert();
        $arr = $model->getAdvert($id);
        var_dump($arr);
        var_dump($arr[0]['id']);
        var_dump($model->views);


        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

//    public function actionViewAdvert()
//    {
//
//        $model = new Advert();
//        $arr = $model->getAdvert($_GET['id']);
//
//        return $this->render('view-advert');
//
//    }

    /**
     * Creates a new Advert model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
//    public function actionCreate()
//    {
//        $model = new Advert();
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        } else {
//            return $this->render('create', [
//                'model' => $model,
//            ]);
//        }
//    }

    /**
     * Updates an existing Advert model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
//        $m = new Advert();
//        var_dump($m->updateAdv());
//        var_dump($model = $this->findModel($id)->getAttributes(['user_id', 'id'])); die;
        //var_dump($this->findModel($id)['_attributes":"yii\db\BaseActiveRecord":private']['user_id']); die;

        var_dump($model = $this->findModel($id));

        $catList = ArrayHelper::map(Category::find()->asArray()->all(), 'id', 'name');
        $subcatList = ArrayHelper::map(Subcategory::find()->asArray()->all(), 'id', 'name');
        $regionList = ArrayHelper::map(Region::find()->asArray()->all(), 'id', 'name');
        $cityList = ArrayHelper::map(City::find()->asArray()->all(), 'id', 'name');

        return $this->render('update',
            [
                'model' => $model,
                'catList' => $catList,
                'subcatList' => $subcatList,
                'regionList' => $regionList,
                'cityList' => $cityList
            ]);

//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        } else {
//            return $this->render('update', [
//                'model' => $model,
//            ]);
//        }
    }

    /**
     * Deletes an existing Advert model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Advert model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Advert the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Advert::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionMy()
    {
        $searchModel = new AdvertCRUD();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('my', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

//    public function actionAdv()
//    {
//        $model = new AdvertUse();
//
//
//        //var_dump($model->create());
//
//        echo '<br><br><br><br><br><br><br>';
//        var_dump($model->create());
//        //var_dump($model->load(Yii::$app->request->post()));
//
//
//        return $this->render('advert', [
//            'model' => $model,
//        ]);
//    }

    public function actionCreate()
    {
        $model = new Advert();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->createAdvert()) {
                return $this->redirect(['my']);
            }

            return $this->render('create', [
                'model' => $model]);
        }

        $catList = ArrayHelper::map(Category::find()->asArray()->all(), 'id', 'name');
        $subcatList = ArrayHelper::map(Subcategory::find()->asArray()->all(), 'id', 'name');
        $regionList = ArrayHelper::map(Region::find()->asArray()->all(), 'id', 'name');
        $cityList = ArrayHelper::map(City::find()->asArray()->all(), 'id', 'name');

        return $this->render('create',
            [
                'model' => $model,
                'catList' => $catList,
                'subcatList' => $subcatList,
                'regionList' => $regionList,
                'cityList' => $cityList
            ]);
    }

    public function actionGetSubcat($id) {

        $countSubcats = Subcategory::find()
            ->where(['category_id' => $id])
            ->count();

        $subcats = Subcategory::find()
            ->where(['category_id' => $id])
            ->orderBy('id ASC')
            ->all();

        if($countSubcats>0){
            foreach($subcats as $subcat){
                echo "<option value='".$subcat->id."'>".$subcat->name."</option>";
            }
        }
        else{
            echo "<option>-</option>";
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    public function actionGetCity($id) {

        $countCities = City::find()
            ->where(['region_id' => $id])
            ->count();

        $cities = City::find()
            ->where(['region_id' => $id])
            ->orderBy('id ASC')
            ->all();

        if($countCities>0){
            foreach($cities as $city){
                echo "<option value='".$city->id."'>".$city->name."</option>";
            }
        }
        else{
            echo "<option>-</option>";
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    public function actionBookmarks()
    {
        $model = new Bookmark();

//        $catList = ArrayHelper::map(Category::find()->asArray()->all(), 'id', 'name');
//        $subcatList = ArrayHelper::map(Subcategory::find()->asArray()->all(), 'id', 'name');

//        return $this->render('bookmarks',
//            [
//                'model' => $model,
//                'catList' => $catList,
//                'subcatList' => $subcatList,
//            ]);

        return $this->render('bookmarks', [
            'model' => $model]);
    }
}
