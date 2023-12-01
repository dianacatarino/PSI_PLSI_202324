<?php

namespace frontend\controllers;
use backend\models\Fornecedor;
use yii\web\NotFoundHttpException;

class AlojamentosController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $fornecedores = Fornecedor::find()->with('imagens')->all();

        return $this->render('index', ['fornecedores' => $fornecedores]);
    }

    public function actionShow($id)
    {
        // Obtém o modelo do alojamento com base no ID
        $fornecedor = Fornecedor::findOne($id);

        // Se o alojamento não for encontrado, lança uma exceção 404
        if (!$fornecedor) {
            throw new NotFoundHttpException('O alojamento não foi encontrado.');
        }

        // Renderiza a visualização com os detalhes do alojamento
        return $this->render('show', [
            'fornecedor' => $fornecedor,
        ]);
    }

}
