<?php

namespace frontend\controllers;

use common\models\Avaliacao;
use Yii;
use yii\web\NotFoundHttpException;

class AvaliacoesController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $avaliacoes = Avaliacao::find()->all();
        return $this->render('index', ['avaliacoes' => $avaliacoes]);
    }

    public function actionCreate($fornecedor_id)
    {
        $avaliacao = new Avaliacao();

        if ($avaliacao->load(Yii::$app->request->post())) {
            $avaliacao->cliente_id = Yii::$app->user->id;
            $avaliacao->fornecedor_id = $fornecedor_id;

            if ($avaliacao->validate()) {
                // Salvar a Avaliação
                $avaliacao->save();

                Yii::$app->session->setFlash('success', 'Avaliação criada com sucesso.');
                return $this->redirect(Yii::$app->request->referrer ?: ['alojamentos/show', 'id' => $fornecedor_id]);
            }
        }

        return $this->render('alojamentos/show', ['avaliacao' => $avaliacao]);
    }

    public function actionEdit($id)
    {
        // Lógica para editar uma avaliação específica
        $avaliacao = Avaliacao::findOne($id);

        if ($avaliacao->load(Yii::$app->request->post()) && $avaliacao->save()) {
            Yii::$app->session->setFlash('success', 'Avaliação atualizada com sucesso.');
            return $this->redirect(['alojamentos/show', 'id' => $avaliacao->fornecedor_id]);
        }

        return $this->render('edit', ['avaliacao' => $avaliacao]);
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
            throw new NotFoundHttpException('A avaliação não foi encontrada.');
        }

        $avaliacao->delete();

        return $this->redirect(['index'], ['avaliacao' => $avaliacao]);
    }
}
