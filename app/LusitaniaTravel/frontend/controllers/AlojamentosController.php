<?php

namespace frontend\controllers;
use backend\models\Fornecedor;

class AlojamentosController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $fornecedores = Fornecedor::find()->with('imagens')->all();

        return $this->render('index', ['fornecedores' => $fornecedores]);
    }

    public function actionView()
    {
        return $this->render('view');
    }

}
