<?php

namespace backend\controllers;

use common\models\Comentario;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

class ComentariosController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'login', 'error', 'contact', 'register', 'perfil', 'definicoes', 'forgot-password','create','edit','show','delete'],
                        'roles' => ['?', '@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => false,
                        'actions' => ['login'],
                        'roles' => ['cliente'],
                        'denyCallback' => function ($rule, $action) {
                            Yii::$app->session->setFlash('error', 'Clientes não têm permissão para acessar o backend.');
                            Yii::$app->user->logout();
                            return $this->goHome();
                        },
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $query = Comentario::find();
        $pagination = new Pagination([
            'totalCount' => $query->count(),
            'defaultPageSize' => 10, // ou o número desejado de itens por página
        ]);
        $comentarios = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'comentarios' => $comentarios,
            'pagination' => $pagination,
        ]);
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
