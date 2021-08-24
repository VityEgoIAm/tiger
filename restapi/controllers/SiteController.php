<?php


namespace restapi\controllers;

use restapi\models\LoginForm;
use restapi\models\SignupForm;
use yii\rest\Controller;
use yii\filters\VerbFilter;

class SiteController extends Controller
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
                    'login'  => ['POST'],
                    'signup'   => ['POST'],
                ],
        ];
        return $behaviors;
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

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();

        if ($model->load(\Yii::$app->request->post(), '') && ($token = $model->signup())) {
            return ['token' => $token];
        } else {
            return $model;
        }
    }
}