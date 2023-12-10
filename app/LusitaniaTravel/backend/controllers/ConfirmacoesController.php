<?php

namespace backend\controllers;

use common\models\Confirmacao;
use common\models\Reserva;
use Yii;
use yii\web\NotFoundHttpException;

class ConfirmacoesController extends \yii\web\Controller
{
    public function actionIndex()
    {
        // Lógica para exibir uma lista de confirmações
        $confirmacoes = Confirmacao::find()->all();

        return $this->render('index', ['confirmacoes' => $confirmacoes]);
    }

    public function actionCreate()
    {
        // Lógica para exibir o formulário de criação de confirmação
        $confirmacao = new Confirmacao();

        if ($confirmacao->load(Yii::$app->request->post()) && $confirmacao->save()) {
            Yii::$app->session->setFlash('success', 'Confirmação criada com sucesso.');
            return $this->redirect(['index']);
        }

        return $this->render('create', ['confirmacao' => $confirmacao]);
    }

    public function actionEdit($id)
    {
        // Lógica para editar uma confirmação específica
        $confirmacao = Confirmacao::findOne($id);

        if ($confirmacao->load(Yii::$app->request->post()) && $confirmacao->save()) {
            Yii::$app->session->setFlash('success', 'Confirmação atualizada com sucesso.');
            return $this->redirect(['index']);
        }

        return $this->render('edit', ['confirmacao' => $confirmacao,
        'selectAlojamentos' => $confirmacao->selectAlojamentos(),
            'selectReservas' => $confirmacao->selectReservas()]);
    }

    public function actionShow($id)
    {
        // Lógica para exibir detalhes de uma confirmação específica
        $confirmacao = Confirmacao::findOne($id);

        return $this->render('show', ['confirmacao' => $confirmacao]);
    }

    public function actionDelete($id)
    {
        // Lógica para excluir uma confirmação específica
        $confirmacao = Confirmacao::findOne($id);

        if ($confirmacao->delete()) {
            Yii::$app->session->setFlash('success', 'Confirmação excluída com sucesso.');
        } else {
            Yii::$app->session->setFlash('error', 'Erro ao excluir a confirmação.');
        }

        return $this->redirect(['index']);
    }
}
