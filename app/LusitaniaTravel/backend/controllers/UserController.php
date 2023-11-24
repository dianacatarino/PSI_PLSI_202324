<?php

namespace backend\controllers;

use common\models\Profile;
use common\models\User;
use Yii;
use yii\web\NotFoundHttpException;

class UserController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $users = User::find()->all();

        return $this->render('index', ['users' => $users]);
    }

    public function actionCreate()
    {
        $model = new User();
        $profile = new Profile();

        if ($model->load(Yii::$app->request->post()) && $profile->load(Yii::$app->request->post())) {
            // Defina a senha, gere a chave de autenticação e o token de verificação de e-mail
            $model->setPassword('user1234');
            $model->generateAuthKey();
            $model->generateEmailVerificationToken();

            // Salve o modelo User
            if ($model->save()) {
                // Associe o perfil ao utilizador recém-criado
                $profile->user_id = $model->id;
                $profile->save();

                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
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

        if (!$user) {
            throw new NotFoundHttpException('O user não foi encontrado.');
        }

        if ($user->load(Yii::$app->request->post()) && $user->save()) {
            return $this->redirect(['user/index']);
        }

        return $this->render('edit', [
            'user' => $user,
        ]);
    }

    public function actionUpdate($id)
    {
        // Recupera os dados do formulário
        $postData = Yii::$app->request->post('User');

        // Realiza a atualização no banco de dados
        $updatedRows = User::updateAll($postData, ['id' => $id]);

        if ($updatedRows > 0) {
            // Redireciona para a página de índice se pelo menos um registro for atualizado
            return $this->redirect(['index']);
        } else {
            // Caso contrário, renderiza novamente a página de edição com os dados existentes
            $user = User::findOne($id);
            return $this->render('edit', ['user' => $user]);
        }
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

        // Encontrar e excluir o perfil associado ao usuário
        $profile = Profile::findOne(['user_id' => $user->id]);
        if ($profile) {
            $profile->delete();
        }

        // Excluir o usuário
        $user->delete();

        return $this->redirect(['index']);
    }
}
