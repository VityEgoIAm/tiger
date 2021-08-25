<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\User;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(); ?>

    <?= $form->field($model, 'email')->input('email') ?>

    <?= $form->field($model, 'status')->dropDownList([User::STATUS_DELETED => 'Deleted', User::STATUS_INACTIVE => 'Inactive', User::STATUS_ACTIVE => 'Active']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
