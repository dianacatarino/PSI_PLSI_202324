<?php

namespace frontend\controllers;

use common\models\Avaliacao;
use common\models\Comentario;
use Yii;

class ComentariosController extends \yii\web\Controller
{
    public function actionIndex()
    {
        // Lógica para exibir uma lista dos comentários
        $comentarios = Comentario::find()->all();
        $avaliacoes = Avaliacao::find()->all();
        return $this->render('index', ['comentarios' => $comentarios , 'avaliacoes' => $avaliacoes]);
    }

    public function actionCreate($fornecedor_id)
    {
        $comentario = new Comentario();
        $avaliacao = new Avaliacao();

        if ($comentario->load(Yii::$app->request->post()) && $avaliacao->load(Yii::$app->request->post())) {
            $comentario->cliente_id = Yii::$app->user->id;
            $comentario->fornecedor_id = $fornecedor_id;

            $avaliacao->cliente_id = Yii::$app->user->id;
            $avaliacao->fornecedor_id = $fornecedor_id;

            $isValid = $comentario->validate() && $avaliacao->validate();
            if ($isValid) {
                // Salvar o Comentario
                $comentario->save();

                // Salvar a Avaliacao
                $avaliacao->save();

                Yii::$app->session->setFlash('success', 'Comentário e avaliação criados com sucesso.');
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', ['comentario' => $comentario , 'avaliacao' => $avaliacao] );
    }

    public function actionEdit($id)
    {
        // Lógica para editar um comentário específico
        $comentario = Comentario::findOne($id);

        if ($comentario->load(Yii::$app->request->post()) && $comentario->save()) {
            Yii::$app->session->setFlash('success', 'Confirmação atualizada com sucesso.');
            return $this->redirect(['index']);
        }

        return $this->render('edit', ['comentario' => $comentario]);

    }


    public function actionShow($id)
    {
        // Lógica para exibir detalhes de um cometario específico
        $comentario = Comentario::findOne($id);
        $avaliacao = Comentario::findOne($id);

        if ($comentario === null && $avaliacao === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        return $this->render('show', ['comentario' => $comentario , 'avaliacao' => $avaliacao ]);
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
