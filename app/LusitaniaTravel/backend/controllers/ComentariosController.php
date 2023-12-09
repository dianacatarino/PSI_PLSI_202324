<?php

namespace backend\controllers;

use common\models\Comentario;
use Yii;
use yii\web\NotFoundHttpException;

class ComentariosController extends \yii\web\Controller
{
    public function actionIndex()
    {

        $comentarios = Comentario::find()->all();

        return $this->render('index', ['comentarios' => $comentarios]);
    }

    public function actionShow($id)
    {
        $comentario = Comentario::findOne($id);

        if (!$comentario) {
            throw new NotFoundHttpException('O comentário não foi encontrado.');
        }
        return $this->render('show', ['comentario' => $comentario]);
    }

    public function actionDelete($id)
    {
        $comentario = Comentario::findOne($id);

        if (!$comentario) {
            throw new NotFoundHttpException('O comentário não foi encontrado.');
        }

        $comentario->delete();

        return $this->redirect(['index'], ['comentario' => $comentario]);
    }
}
