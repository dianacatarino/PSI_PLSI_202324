<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Login';
?>
<div class="login-box" style="max-width: 400px; margin: 0 auto;">
    <div class="login-logo">
        <a href="index.html"><b>Lusitânia </b>Travel</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in to start your session</p>

            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

            <?= $form->field($model, 'username', ['template' => '<div class="input-group mb-3">{input}<div class="input-group-append"><div class="input-group-text"><span class="fas fa-user"></span></div></div></div>{error}'])->textInput(['autofocus' => true, 'class' => 'form-control', 'placeholder' => 'Username'])->label(false) ?>

            <?= $form->field($model, 'password', ['template' => '<div class="input-group mb-3">{input}<div class="input-group-append"><div class="input-group-text"><span class="fas fa-lock"></span></div></div></div>{error}'])->passwordInput(['class' => 'form-control', 'placeholder' => 'Password'])->label(false) ?>

            <div class="row">
                <div class="col-8">
                    <?= $form->field($model, 'rememberMe')->checkbox(['class' => 'icheck-primary']) ?>
                </div>
                <!-- /.col -->
                <div class="col-4">
                    <?= Html::submitButton('Sign In', ['class' => 'btn btn-primary btn-block']) ?>
                </div>
                <!-- /.col -->
            </div>

            <?php ActiveForm::end(); ?>

            <p class="mb-1">
                <a href="forgot-password.html">I forgot my password</a>
            </p>
            <p class="mb-0">
                <a href="<?= Yii::$app->urlManager->createUrl(['site/register']) ?>" class="text-center">Register a new membership</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->





