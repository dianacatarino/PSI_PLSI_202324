<?php

namespace frontend\controllers;
use common\models\Fornecedor;
use common\models\Linhasreserva;
use common\models\Reserva;
use common\models\Comentario;
use common\models\Avaliacao;
use Yii;
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
        $fornecedor = Fornecedor::findOne($id);

        $comentario = new Comentario();
        $avaliacao = new Avaliacao();

        if ($fornecedor === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        return $this->render('show', [
            'avaliacao' => $avaliacao,
            'comentario' => $comentario,
            'fornecedor' => $fornecedor,
        ]);
    }

}
