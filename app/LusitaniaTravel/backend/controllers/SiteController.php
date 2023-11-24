<?php

namespace backend\controllers;

use app\models\PasswordResetForm;
use common\models\LoginForm;
use common\models\SignupForm;
use common\models\User;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login', 'error', 'contact','register','perfil','definicoes','forgot-password'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout', 'index'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', ['model' => $model]);
    }

    public function actionRegister()
    {
        $model = new SignupForm();
        $this->layout = 'blank';

        if ($model->load(Yii::$app->request->post())) {
            // Verificar se o usuário já está registrado
            if ($model->isRegistered()) {
                Yii::$app->session->setFlash('error', 'Este utilizador já está registrado.');
            } elseif ($model->register()) {
                // Redirecionar para a página de login após o registro bem-sucedido
                return $this->redirect(['login']);
            }
        }

        return $this->render('register', ['model' => $model]);
    }

    public function actionForgotPassword()
    {
        $this->layout = 'blank';

        $model = new PasswordResetForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            Yii::$app->session->setFlash('success', 'Link para redefinição de senha gerado. Verifique seu e-mail para obter mais instruções.');
            return $this->goHome(); // Redirect to home or another page
        }

        return $this->render('forgotpassword', [
            'model' => $model,
        ]);
    }

    public function actionPerfil()
    {
        return $this->render('perfil');
    }

    public function actionDefinicoes()
    {
        return $this->render('definicoes');
    }

    public function actionAlojamentos()
    {
        return $this->render('alojamentos/index');
    }

    public function actionReservas()
    {
        return $this->render('reservas/index');
    }

    public function actionFaturas()
    {
        return $this->render('faturas/index');
    }

    public function actionEmpresa()
    {
        return $this->render('empresa/index');
    }

    public function actionFornecedores()
    {
        return $this->render('fornecedores/index');
    }

    public function actionUser()
    {
        return $this->render('user/index');
    }

    public function actionContact()
    {
        return $this->render('contact');
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
