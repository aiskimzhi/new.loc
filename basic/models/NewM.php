<?php
 namespace app\models;

 use yii\db\ActiveRecord;
 use yii\base\Model;
 use yii\data\ActiveDataProvider;

 class NewM extends ActiveRecord
 {
     public function scenarios()
     {
         // bypass scenarios() implementation in the parent class
         return Model::scenarios();
     }

     public function rules()
     {
         return [
             [['id'], 'integer'],
             [['first_name', 'last_name', 'password', 'email', 'skype', 'phone', 'auth_key', 'password_reset_token'], 'safe'],
         ];
     }

     public function search($params)
     {
         $query = User::find();

         $dataProvider = new ActiveDataProvider([
             'query' => $query,
         ]);

         $this->load($params);

         if (!$this->validate()) {
             // uncomment the following line if you do not want to return any records when validation fails
             // $query->where('0=1');
             return $dataProvider;
         }

         $query->andFilterWhere([
             'id' => $this->id,
         ]);

         $query->andFilterWhere(['like', 'first_name', $this->first_name])
             ->andFilterWhere(['like', 'last_name', $this->last_name])
             ->andFilterWhere(['like', 'password', $this->password])
             ->andFilterWhere(['like', 'email', $this->email])
             ->andFilterWhere(['like', 'skype', $this->skype])
             ->andFilterWhere(['like', 'phone', $this->phone])
             ->andFilterWhere(['like', 'auth_key', $this->auth_key])
             ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token]);

         return $dataProvider;
     }


 }