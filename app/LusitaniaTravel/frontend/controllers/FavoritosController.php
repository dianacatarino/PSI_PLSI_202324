<?php

namespace frontend\controllers;

use Yii;

class FavoritosController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionAtualizar()
    {
        $fornecedorId = Yii::$app->request->post('fornecedorId');
        $user = Yii::$app->user->identity;

        // Faça a lógica para adicionar ou remover o fornecedor dos favoritos do usuário
        // ...

        // Redirecione de volta à página anterior ou para onde for apropriado
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionView()
    {
        return $this->render('view');
    }

}
