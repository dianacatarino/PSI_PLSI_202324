<?php

namespace backend\controllers;

use backend\models\Avaliacao;
use Yii;
use yii\web\NotFoundHttpException;

class AvaliacoesController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $avaliacoes = Avaliacao::find()->all();

        return $this->render('index', ['avaliacoes' => $avaliacoes]);
    }

    public function actionShow($id)
    {
        $avaliacao = Avaliacao::findOne($id);

        if (!$avaliacao) {
            throw new NotFoundHttpException('A avaliação não foi encontrada.');
        }
        return $this->render('show', ['avaliacao' => $avaliacao]);
    }

    public function actionDelete($id)
    {
        $avaliacao = Avaliacao::findOne($id);

        if (!$avaliacao) {
            throw new NotFoundHttpException('O comentário não foi encontrado.');
        }

        $avaliacao->delete();

        return $this->redirect(['index'], ['avaliacao' => $avaliacao]);
    }
}
