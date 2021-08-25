<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // добавляем роль "admin" 
        $admin = $auth->createRole('admin');
        $auth->add($admin);

        // Назначение ролей пользователям. 
        $auth->assign($admin, 1);
    }
}