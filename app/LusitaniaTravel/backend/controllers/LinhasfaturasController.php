<?php

namespace backend\controllers;

use common\models\Linhasfatura;
use Yii;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

class LinhasfaturasController extends \yii\web\Controller
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
        $linhasfaturas = Linhasfatura::find()->all();

        return $this->render('index', ['linhasfaturas' => $linhasfaturas]);

    }

    public function actionShow($id)
    {
        $linhafatura = Linhasfatura::findOne($id);

        if ($linhafatura === null) {
            throw new NotFoundHttpException('A página solicitada não existe.');
        }

        return $this->render('show', ['linhafatura' => $linhafatura]);
    }

    public function actionEdit($id)
    {
        $linhafatura = Linhasfatura::findOne($id);

        if ($linhafatura === null) {
            throw new NotFoundHttpException('A página solicitada não existe.');
        }

        // Lógica de edição aqui

        return $this->render('edit', ['linhafatura' => $linhafatura]);
    }

    public function actionDelete($id)
    {
        $linhafatura = Linhasfatura::findOne($id);

        if ($linhafatura === null) {
            throw new NotFoundHttpException('A página solicitada não existe.');
        }

        // Lógica de exclusão aqui

        return $this->render('delete', ['linhafatura' => $linhafatura]);
    }
}