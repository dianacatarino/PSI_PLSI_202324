<?php

namespace backend\controllers;

use common\models\Confirmacao;
use common\models\Reserva;
use Yii;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

class ConfirmacoesController extends \yii\web\Controller
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

    public function actionEdit($id)
    {
        // Lógica para editar uma confirmação específica
        $confirmacao = Confirmacao::findOne($id);

        if ($confirmacao->load(Yii::$app->request->post())) {
            // Verificar se o estado foi alterado para Confirmado ou Cancelado
            if ($confirmacao->estado == 'Confirmado' || $confirmacao->estado == 'Cancelado') {
                // Atualizar a data de confirmação automaticamente
                $confirmacao->dataconfirmacao = date('Y-m-d');
            }

            if ($confirmacao->save()) {
                Yii::$app->session->setFlash('success', 'Confirmação atualizada com sucesso.');
                return $this->redirect(['index']);
            }
        }

        return $this->render('edit', [
            'confirmacao' => $confirmacao,
            'selectAlojamentos' => $confirmacao->selectAlojamentos(),
            'selectReservas' => $confirmacao->selectReservas(),
        ]);
    }

    public function actionShow($id)
    {
        // Lógica para exibir detalhes de uma confirmação específica
        $confirmacao = Confirmacao::findOne($id);

        return $this->render('show', ['confirmacao' => $confirmacao]);
    }

    public function actionDelete($id)
    {
        // Lógica para excluir uma confirmação específica
        $confirmacao = Confirmacao::findOne($id);

        if ($confirmacao->delete()) {
            Yii::$app->session->setFlash('success', 'Confirmação excluída com sucesso.');
        } else {
            Yii::$app->session->setFlash('error', 'Erro ao excluir a confirmação.');
        }

        return $this->redirect(['index']);
    }
}
