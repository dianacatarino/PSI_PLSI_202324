<?php

namespace backend\controllers;

use common\models\Profile;
use common\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

class UserController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'login', 'error', 'contact', 'register', 'perfil', 'definicoes', 'forgot-password', 'create', 'store', 'edit', 'update', 'show', 'delete'],
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

    public function actionIndex()
    {
        $users = User::find()->all();

        return $this->render('index', ['users' => $users]);
    }

    public function actionCreate()
    {
        $user = new User();
        $profile = new Profile();

        if ($user->load(Yii::$app->request->post()) && $profile->load(Yii::$app->request->post())) {
            // Defina a senha, gere a chave de autenticação e o token de verificação de e-mail
            $user->setPassword('user1234');
            $user->generateAuthKey();
            $user->generateEmailVerificationToken();

            // Salve o modelo User
            if ($user->save()) {
                // Associe o perfil ao utilizador recém-criado
                $profile->user_id = $user->id;
                $profile->save();

                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'user' => $user,
            'profile' => $profile,
        ]);
    }

    public function actionStore()
    {
        $userData = Yii::$app->request->post('User');
        $profileData = Yii::$app->request->post('Profile');

        // Defina a senha fixa desejada
        $fixedPassword = 'user1234';

        // Crie uma nova instância do modelo User
        $user = new User($userData);

        // Atribua a senha fixa
        $user->setPassword($fixedPassword);

        // Gere a chave de autenticação e o token de verificação de e-mail
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();

        // Salve o modelo User
        if ($user->save()) {
            // Associe o perfil ao utilizador recém-criado
            $profile = new Profile();
            $profile->user_id = $user->id;

            // Carregue os dados do perfil a partir do formulário
            if ($profile->load(Yii::$app->request->post()) && $profile->save()) {
                return $this->redirect(['user/index']);
            }
        }

        return $this->renderView('user', 'create', ['user' => $user, 'profile' => $profile]);
    }

    public function actionEdit($id)
    {
        $user = User::findOne($id);
        $profile = $user->profile;

        if (!$user) {
            throw new NotFoundHttpException('O utilizador não foi encontrado.');
        }

        return $this->render('edit', [
            'user' => $user,
            'profile' => $profile,
        ]);
    }

    public function actionUpdate($id)
    {
        $user = User::findOne($id);

        if (!$user) {
            throw new NotFoundHttpException('O utilizador não foi encontrado.');
        }

        $profile = $user->profile;

        if ($user->load(Yii::$app->request->post()) && $profile->load(Yii::$app->request->post())) {
            // Validate and save the user and profile models
            if ($user->save() && $profile->save()) {
                return $this->redirect(['user/index']);
            }
        }

        return $this->render('update', [
            'user' => $user,
            'profile' => $profile,
        ]);
    }

    public function actionShow($id)
    {
        $user = User::findOne($id);

        if (!$user) {
            throw new NotFoundHttpException('O user não foi encontrado.');
        }

        $profile = $user->profile;

        return $this->render('show', [
            'user' => $user,
            'profile' => $profile,
        ]);
    }

    public function actionDelete($id)
    {
        $user = User::findOne($id);

        if (!$user) {
            throw new NotFoundHttpException('O user não foi encontrado.');
        }

        // Encontrar e excluir o perfil associado ao utilizador
        $profile = Profile::findOne(['user_id' => $user->id]);
        if ($profile) {
            $profile->delete();
        }

        // Excluir o utilizador
        $user->delete();

        return $this->redirect(['index']);
    }
}
