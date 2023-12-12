<?php

namespace frontend\controllers;

use common\models\Comentario;
use Yii;

class ComentariosController extends \yii\web\Controller
{
    public function actionIndex()
    {
        // Lógica para exibir uma lista dos comentários
        $comentarios = Comentario::find()->all();

        return $this->render('index', ['comentarios' => $comentarios]);
    }

    public function actionCreate()
    {
        // TODO: confirmar se a lógica será esta devido ao index
        $comentario = new Comentario();

        if ($comentario->load(Yii::$app->request->post()) && $comentario->save()) {
            Yii::$app->session->setFlash('success', 'Comentário criada com sucesso.');
            return $this->redirect(['index']);
        }

        return $this->render('create', ['comentario' => $comentario]);
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

        return $this->render('show', ['coemtario' => $comentario]);
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
