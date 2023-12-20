<?php

namespace backend\controllers;

use common\models\Linhasfatura;
use Yii;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

class LinhasfaturasController extends \yii\web\Controller
{

    /*public function behaviors()
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
    }*/

    public function actionIndex()
    {
        $linhasfaturas = Linhasfatura::find()->all();

        return $this->render('index', ['linhasfaturas' => $linhasfaturas]);

    }

    public function actionCreate()
    {
        return $this->render('create');
    }

    public function actionStore()
    {
        return $this->render('store');
    }

    public function actionEdit()
    {
        return $this->render('edit');
    }

    public function actionUpdate()
    {
        return $this->render('update');
    }

    public function actionShow($id)
    {
        return $this->render('show');
    }

    public function actionDelete()
    {
        return $this->render('delete');
    }
}