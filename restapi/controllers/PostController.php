<?php


namespace restapi\controllers;

use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\rest\ActiveController;

use restapi\models\Post;
use restapi\models\PostForm;

class PostController extends ActiveController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['verbs'] = [
            'class' => VerbFilter::className(),
                'actions' => [
                    'index'  => ['GET'],
                    'create' => ['POST'],
                ],
        ];
        return $behaviors;
    }

    public $modelClass = 'restapi\models\Post';

    public function actions()
    {
        $actions = parent::actions();

        unset($actions['index'], $actions['view'], $actions['create'], $actions['delete'], $actions['update'], $actions['options']);

        return $actions;
    }

    public function actionIndex($limit = 5, $offset = 0)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Post::find()->limit($limit)->offset($offset),
            'pagination' => false,
        ]);

        return $dataProvider;
    }

    public function actionCreate()
    {
        $model = new PostForm();

        if ($model->load(\Yii::$app->request->post(), '') && ($token = $model->savePost())) {
            return ['result' => 'Пост успешно сохранен.'];
        } else {
            return $model;
        }
    }
}