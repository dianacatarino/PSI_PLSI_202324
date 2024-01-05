<?php

namespace backend\controllers;

use backend\models\Empresa;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use Yii;

class EmpresaController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'login', 'error', 'contact', 'register', 'perfil', 'definicoes', 'forgot-password','create','store','edit','update','show','delete'],
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
        $empresas = Empresa::find()->all();

        return $this->render('index', ['empresas' => $empresas]);
    }

    public function actionCreate()
    {
        // Verificar se já existe uma empresa
        $existingEmpresa = Empresa::find()->one();

        // Se já existe uma empresa, adicionar mensagem flash e redirecionar para o índice
        if ($existingEmpresa !== null) {
            Yii::$app->session->setFlash('error', 'Já existe uma empresa criada.');
            return $this->redirect(['index']);
        }

        $empresa = new Empresa();

        if ($empresa->load(Yii::$app->request->post()) && $empresa->save()) {
            Yii::$app->session->setFlash('success', 'Empresa criada com sucesso.');
            return $this->redirect(['index']);
        }

        return $this->render('create', ['empresa' => $empresa]);
    }

    public function actionStore()
    {
        $empresa = new Empresa();

        if ($empresa->load(Yii::$app->request->post()) && $empresa->save()) {
            return $this->redirect(['index']);
        }
        return $this->render('create', ['empresa' => $empresa]);
    }

    public function actionEdit($id)
    {
        $empresa = Empresa::findOne($id);

        if (!$empresa) {
            throw new NotFoundHttpException('A empresa não foi encontrada.');
        }

        return $this->render('edit', ['empresa' => $empresa]);
    }

    public function actionUpdate($id)
    {
        $empresa = Empresa::findOne($id);

        if (!$empresa) {
            throw new NotFoundHttpException('A empresa não foi encontrada.');
        }

        if ($empresa->load(Yii::$app->request->post()) && $empresa->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', ['empresa' => $empresa]);
    }

    public function actionShow($id)
    {
        $empresa = Empresa::findOne($id);

        if (!$empresa) {
            throw new NotFoundHttpException('A empresa não foi encontrada.');
        }

        return $this->render('show', ['empresa' => $empresa]);
    }

    public function actionDelete($id)
    {
        $empresa = Empresa::findOne($id);

        if (!$empresa) {
            throw new NotFoundHttpException('A empresa não foi encontrada.');
        }

        $empresa->delete();

        return $this->redirect(['index']);
    }
}
