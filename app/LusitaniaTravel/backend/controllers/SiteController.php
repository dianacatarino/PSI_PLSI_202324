<?php

namespace backend\controllers;

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

    /*public function beforeAction($action)
    {
        // Verifique se o usuário está autenticado
        if (!Yii::$app->user->isGuest) {
            // Obtenha a ID do usuário atualmente autenticado
            $userId = Yii::$app->user->getId();

            // Consulte o banco de dados para obter a role do usuário
            $userRole = User::find()->select('role')->where(['id' => $userId])->scalar();

            // Defina o layout com base na role do usuário
            switch ($userRole) {
                case 'admin':
                    $this->layout = 'main';
                    break;
                case 'funcionario':
                    $this->layout = 'funcionario';
                    break;
                case 'fornecedor':
                    $this->layout = 'fornecedor';
                    break;
                default:
                    $this->layout = 'defaultLayout';
                    break;
            }
        }

        return parent::beforeAction($action);
    }*/

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
                // Antes de atribuir a função, verifique se ela existe
                $auth = Yii::$app->authManager;
                $role = $auth->getRole($model->userType);

                if ($role !== null) {
                    // Obtendo o usuário recém-criado
                    $user = User::findByUsername($model->username);

                    // Verificar se o usuário já tem essa atribuição
                    if (!$auth->checkAccess($user->id, $role->name)) {
                        // Atribuindo a função ao usuário
                        $auth->assign($role, $user->id);
                    } else {
                        Yii::warning('O utilizador já tem a função atribuída.');
                    }
                }

                return $this->redirect(['login']);
            }
        }

        return $this->render('register', ['model' => $model]);
    }

    public function actionForgotPassowrd()
    {
        return $this->render('forgotpassword');
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
