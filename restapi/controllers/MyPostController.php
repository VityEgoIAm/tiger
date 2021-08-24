<?php


namespace restapi\controllers;

use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBasicAuth;
use yii\rest\Controller;

use restapi\models\Post;

class MyPostController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBasicAuth::class,
        ];
        return $behaviors;
    }

    public function actionIndex($limit = 5, $offset = 0)
    {
        $user = \Yii::$app->user->identity;
        
        $dataProvider = new ActiveDataProvider([
            'query' => Post::find()->where(['user_id' => $user->id])->limit($limit)->offset($offset),
            'pagination' => false,
        ]);

        return $dataProvider;
    }
}