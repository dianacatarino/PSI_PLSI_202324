<?php

namespace backend\controllers;

use common\models\Confirmacao;
use common\models\Fornecedor;
use common\models\Linhasfatura;
use common\models\Reserva;
use common\models\Linhasreserva;
use DateTime;
use frontend\models\Carrinho;
use Yii;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

class ReservasController extends \yii\web\Controller
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
        $reservas = Reserva::find()->with('linhasreservas')->all();

        return $this->render('index', ['reservas' => $reservas]);
    }

    public function actionCreate()
    {
        $reserva = new Reserva();

        if ($reserva->load(Yii::$app->request->post())) {
            // Calcula a diferença em dias entre checkin e checkout
            $checkin = new DateTime($reserva->checkin);
            $checkout = new DateTime($reserva->checkout);
            $diferencaDias = $checkout->diff($checkin)->days;

            // Obtém o fornecedor
            $fornecedor = Fornecedor::findOne($reserva->fornecedor_id);

            if ($fornecedor) {
                // Calcula o valor total da reserva
                $reserva->valor = $diferencaDias * $fornecedor->precopornoite * $reserva->numeroquartos;

                if ($reserva->save()) {
                    // Restante do código para criar a confirmação e redirecionar
                    $confirmacao = new Confirmacao();
                    $confirmacao->estado = 'Pendente'; // Estado pendente
                    $confirmacao->dataconfirmacao = null; // Data de confirmação nula

                    // Atribui a reserva associada à confirmação
                    $confirmacao->reserva_id = $reserva->id;
                    $confirmacao->fornecedor_id = $reserva->fornecedor_id;
                    $confirmacao->save();

                    Yii::$app->session->setFlash('success', 'Reserva criada com sucesso.');
                    return $this->redirect(['index']);
                } else {
                    Yii::error('Error saving reserva to database.');
                    Yii::error($reserva->errors);
                }
            } else {
                Yii::$app->session->setFlash('error', 'Fornecedor não encontrado.');
            }
        }

        return $this->render('create', [
            'reserva' => $reserva,
            'selectAlojamentos' => $reserva->selectAlojamentos(),
            'selectClientes' => $reserva->selectClientes(),
            'selectFuncionarios' => $reserva->selectFuncionarios(),
        ]);
    }

    public function actionEdit($id)
    {
        $reserva = Reserva::findOne($id);

        if ($reserva->load(Yii::$app->request->post()) && $reserva->save()) {
            Yii::$app->session->setFlash('success', 'Reserva atualizada com sucesso.');
            return $this->redirect(['index']);
        }

        return $this->render('edit', ['reserva' => $reserva,
        'selectAlojamentos' => $reserva->selectAlojamentos(),
        'selectClientes' => $reserva->selectClientes(),
        'selectFuncionarios' => $reserva->selectFuncionarios()]);
    }

    public function actionShow($id)
    {
        $reserva = Reserva::findOne($id);

        if (!$reserva) {
            throw new NotFoundHttpException('A reserva não foi encontrada.');
        }

        return $this->render('show', ['reserva' => $reserva]);
    }

    public function actionDelete($id)
    {
        $reserva = Reserva::findOne($id);

        if ($reserva === null) {
            throw new NotFoundHttpException('A reserva não foi encontrada.');
        }

        // Verificar se há uma reserva associada ao carrinho
        $carrinhoComReserva = Carrinho::find()->where(['reserva_id' => $reserva->id])->exists();

        if ($carrinhoComReserva) {
            Yii::$app->session->setFlash('error', 'Não é possível excluir a reserva, pois ela está associada ao carrinho.');
            return $this->redirect(['index']);
        }

        // Encontrar a confirmação associada à reserva
        $confirmacoes = $reserva->confirmacoes;

        // Encontrar e excluir as linhas associadas à reserva
        Linhasreserva::deleteAll(['reservas_id' => $reserva->id]);

        // Agora, você pode excluir a confirmação e a reserva sem violar a restrição de chave estrangeira
        if (!empty($confirmacoes)) {
            foreach ($confirmacoes as $confirmacao) {
                $confirmacao->delete();
            }
        }

        $reserva->delete();

        Yii::$app->session->setFlash('success', 'Reserva eliminada com sucesso.');

        return $this->redirect(['index']);
    }
}