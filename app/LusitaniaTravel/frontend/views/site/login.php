<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- Login Form Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <h1 class="text-center text-primary text-uppercase mb-4">Login</h1>

                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'class' => 'form-control rounded-0', 'placeholder' => 'Username']) ?>

                <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control rounded-0', 'placeholder' => 'Password']) ?>

                <?= $form->field($model, 'rememberMe')->checkbox(['template' => "<div class=\"custom-control custom-checkbox\">{input} {label}</div>", 'class' => 'custom-control-input']) ?>

                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary rounded-0 w-100', 'name' => 'login-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>

                <div class="text-center">
                    <p class="mb-2"><a href="index.php?r=site/resetPassword">Forgot your password?</a></p>
                    <p>Don't have an account? <a href="index.php?r=site/register">Sign Up</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Login Form End -->
