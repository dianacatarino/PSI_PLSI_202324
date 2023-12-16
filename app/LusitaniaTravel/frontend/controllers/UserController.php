<?php

namespace frontend\controllers;

use Yii;

class UserController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionDefinicoes()
    {
        $user = Yii::$app->user->identity;
        $profile = $user->profile;

        if (Yii::$app->request->isPost) {
            $profile->load(Yii::$app->request->post());

            // Lógica para salvar as alterações no perfil
            if ($profile->save()) {
                Yii::$app->session->setFlash('success', 'Alterações salvas com sucesso.');
            } else {
                Yii::$app->session->setFlash('error', 'Erro ao salvar as alterações.');
            }

            // Redirecionar para o user index após salvar as alterações
            return $this->redirect(['user/index']);
        }

        return $this->render('definicoes', ['user' => $user, 'profile' => $profile]);
    }

}
