<?php


namespace restapi\controllers;

use restapi\models\LoginForm;
use yii\rest\Controller;
use yii\filters\VerbFilter;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'login' => ['post'],
                ],
            ],
        ];
    }

    public function actionLogin()
    {
        $model = new LoginForm;

        if ($model->load(\Yii::$app->request->post(), '') && ($token = $model->login())) {
            return ['token' => $token];
        } else {
            return $model;
        }
    }
}