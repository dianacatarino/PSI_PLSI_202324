<?php

namespace backend\controllers;

use app\models\PasswordResetForm;
use common\models\Confirmacao;
use common\models\Fornecedor;
use common\models\LoginForm;
use common\models\Profile;
use common\models\Reserva;
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
                        'actions' => ['index', 'login', 'error', 'contact', 'register', 'perfil', 'definicoes', 'forgot-password'],
                        'roles' => ['?', '@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => false,
                        'actions' => ['login'],
                        'roles' => ['cliente'],
                        'denyCallback' => function ($rule, $action) {
                            Yii::$app->session->setFlash('error', 'Clientes não têm permissão para acessar o backend.');
                            Yii::$app->user->logout();
                            return $this->goHome();
                        },
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

    /*private function configureLayout()
    {
        if (!Yii::$app->user->isGuest) {
            $userRole = Yii::$app->user->identity->profile->role;

            switch ($userRole) {
                case 'admin':
                    $this->layout = 'main';
                    break;
                case 'fornecedor':
                    $this->layout = 'fornecedor';
                    break;
                case 'funcionario':
                    $this->layout = 'funcionario';
                    break;
                default:
                    $this->layout = 'blank';
                    break;
            }
        }
    }*/


    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {

        // Count de novos alojamentos
        $novosAlojamentos = Fornecedor::find()->count();

        // Count de novas reservas
        $novasReservas = Reserva::find()->count();

        // Count de novos utilizadores
        $novosUtilizadores = User::find()->count();

        // Calcular a taxa de reservas
        $totalReservas = Reserva::find()->count();
        $reservasConfirmadas = Confirmacao::find()->where(['estado' => 'Confirmado'])->count();

        // Evitar divisão por zero
        $taxaReservas = $totalReservas > 0 ? ($reservasConfirmadas / $totalReservas) * 100 : 0;

        return $this->render('index', [
            'novosAlojamentos' => $novosAlojamentos,
            'novasReservas' => $novasReservas,
            'taxaReservas' => $taxaReservas,
            'novosUtilizadores' => $novosUtilizadores,
        ]);
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
            // Obter o perfil associado ao usuário
            $profile = Profile::findOne(['user_id' => Yii::$app->user->id]); // Substitua 'user_id' pelo campo correto de relacionamento

            // Verificar se o usuário tem uma das roles permitidas (admin, funcionario, fornecedor) com base no perfil
            if ($profile && in_array($profile->getRole(), ['admin', 'funcionario', 'fornecedor'])) {
                return $this->goBack();
            } else {
                Yii::$app->user->logout(); // Logout se o usuário não tiver permissão
                Yii::$app->session->setFlash('error', 'Você não tem permissão para fazer login.');
                return $this->redirect(['site/login']);
            }
        }

        if ($model->hasErrors() && $model->getFirstError('password') !== null) {
            Yii::$app->session->setFlash('error', 'Senha incorreta. Por favor, tente novamente.');
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

        return $this->redirect(['login']);
    }
}
