<?php

namespace backend\controllers;

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

        if ($model->load(Yii::$app->request->post())) {
            // Defina a senha, gere a chave de autenticação e o token de verificação de e-mail
            $model->setPassword($model->password); // Supondo que o campo de senha seja chamado 'password'
            $model->generateAuthKey();
            $model->generateEmailVerificationToken();

            // Salve o modelo
            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionStore()
    {
        $postData = Yii::$app->request->post('User');

        // Defina a senha fixa desejada
        $fixedPassword = 'user1234';

        // Crie uma nova instância do modelo User
        $user = new User($postData);

        // Atribua a senha fixa
        $user->setPassword($fixedPassword);

        // Gere a chave de autenticação e o token de verificação de e-mail
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();

        // Salve o modelo
        if ($user->save()) {
            return $this->redirect(['user/index']);
        } else {
            return $this->renderView('user', 'create', ['user' => $user]);
        }
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

        return $this->render('show', [
            'user' => $user,
        ]);
    }

    public function actionDelete($id)
    {
        $user = User::findOne($id);

        if (!$user) {
            throw new NotFoundHttpException('O usuário não foi encontrado.');
        }

        $user->delete();

        return $this->redirect(['index']);
    }
}
