<?php

namespace backend\controllers;

use app\models\Confirmacao;
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

    public function actionStore()
    {
        $confirmacao = new Confirmacao();

        if ($confirmacao->load(Yii::$app->request->post()) && $confirmacao->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('create', ['confirmacao' => $confirmacao]);
    }

    public function actionEdit($id)
    {
        // Lógica para editar uma confirmação específica
        $confirmacao = $this->findModel($id);

        if ($confirmacao->load(Yii::$app->request->post()) && $confirmacao->save()) {
            Yii::$app->session->setFlash('success', 'Confirmação atualizada com sucesso.');
            return $this->redirect(['index']);
        }

        return $this->render('edit', ['confirmacao' => $confirmacao]);
    }

    public function actionUpdate($id)
    {
        $confirmacao = $this->findModel($id);

        if ($confirmacao->load(Yii::$app->request->post()) && $confirmacao->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', ['confirmacao' => $confirmacao]);
    }

    public function actionShow($id)
    {
        // Lógica para exibir detalhes de uma confirmação específica
        $confirmacao = $this->findModel($id);

        return $this->render('show', ['confirmacao' => $confirmacao]);
    }

    public function actionDelete($id)
    {
        // Lógica para excluir uma confirmação específica
        $confirmacao = $this->findModel($id);

        if ($confirmacao->delete()) {
            Yii::$app->session->setFlash('success', 'Confirmação excluída com sucesso.');
        } else {
            Yii::$app->session->setFlash('error', 'Erro ao excluir a confirmação.');
        }

        return $this->redirect(['index']);
    }

    // Método auxiliar para encontrar o modelo Confirmacoes pelo ID
    protected function findModel($id)
    {
        $confirmacao = Confirmacao::findOne($id);

        if ($confirmacao === null) {
            throw new NotFoundHttpException('A confirmação não foi encontrada.');
        }

        return $confirmacao;
    }
}
