<?php

namespace frontend\controllers;

use common\models\Avaliacao;
use common\models\Comentario;
use Yii;
use yii\web\NotFoundHttpException;

class ComentariosController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $userId = Yii::$app->user->id;

        $comentarios = Comentario::find()
            ->where(['cliente_id' => $userId])
            ->all();

        $avaliacoes = Avaliacao::find()
            ->where(['cliente_id' => $userId])
            ->all();

        return $this->render('index', ['comentarios' => $comentarios, 'avaliacoes' => $avaliacoes]);
    }

    public function actionCreate($fornecedor_id)
    {
        $comentario = new Comentario();

        if ($comentario->load(Yii::$app->request->post())) {
            $comentario->cliente_id = Yii::$app->user->id;
            $comentario->fornecedor_id = $fornecedor_id;

            if ($comentario->validate()) {
                // Salvar o Comentário
                $comentario->save();

                Yii::$app->session->setFlash('success', 'Comentário criado com sucesso.');
                return $this->redirect(Yii::$app->request->referrer ?: ['alojamentos/show', 'id' => $fornecedor_id]);
            }
        }

        return $this->render('create', ['comentario' => $comentario]);
    }

    public function actionEdit($id)
    {
        $comentario = Comentario::findOne($id);
        $avaliacoes = Avaliacao::find()->where(['id' => $comentario->id])->all();

        if ($comentario->load(Yii::$app->request->post()) && $comentario->save()) {
            Yii::$app->session->setFlash('success', 'Confirmação atualizada com sucesso.');
            return $this->redirect(['index']);
        }

        return $this->render('edit', [
            'comentario' => $comentario,
            'avaliacoes' => $avaliacoes,
        ]);
    }

    public function actionShow($id)
    {
        // Lógica para exibir detalhes de um comentário específico
        $comentario = Comentario::findOne($id);

        if ($comentario === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        // Obter avaliações associadas com base em fornecedor_id e user_id
        $avaliacoes = Avaliacao::find()
            ->where(['fornecedor_id' => $comentario->fornecedor_id, 'cliente_id' => $comentario->cliente_id])
            ->all();

        return $this->render('show', ['comentario' => $comentario, 'avaliacoes' => $avaliacoes]);
    }

    public function actionDelete($id)
    {
        // Lógica para excluir um comentário específica
        $comentario = Comentario::findOne($id);

        if ($comentario->delete()) {
            Yii::$app->session->setFlash('success', 'Comentário excluída com sucesso.');
        } else {
            Yii::$app->session->setFlash('error', 'Erro ao excluir o comentário.');
        }

        return $this->redirect(['index']);
    }


}
