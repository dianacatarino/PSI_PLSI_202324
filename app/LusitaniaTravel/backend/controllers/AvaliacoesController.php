<?php

namespace backend\controllers;

use common\models\Avaliacao;
use Yii;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

class AvaliacoesController extends \yii\web\Controller
{
    /*public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'login', 'error', 'contact', 'register', 'perfil', 'definicoes', 'forgot-password'],
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
    }*/

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
