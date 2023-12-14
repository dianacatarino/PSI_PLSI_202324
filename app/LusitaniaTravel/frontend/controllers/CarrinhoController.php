<?php

namespace frontend\controllers;

use common\models\Linhasreserva;
use common\models\Reserva;
use frontend\models\Carrinho;
use Yii;
use yii\web\NotFoundHttpException;

class CarrinhoController extends \yii\web\Controller
{
    public function actionIndex()
    {
        // Obter o ID do cliente atualmente logado
        $clienteId = Yii::$app->user->identity->id;

        // Buscar itens do carrinho para o cliente atual
        $itensCarrinho = Carrinho::find()->where(['cliente_id' => $clienteId])->all();

        // Calcular o total do carrinho
        $totalCarrinho = 0;
        foreach ($itensCarrinho as $item) {
            $totalCarrinho += $item->preco;
        }

        return $this->render('index', [
            'itensCarrinho' => $itensCarrinho,
            'totalCarrinho' => $totalCarrinho,
        ]);
    }

    public function actionAdicionar($fornecedorId)
    {
        // Verificar se o usuário está logado
        if (Yii::$app->user->isGuest) {
            // Redirecionar para a página de login se o usuário não estiver logado
            return $this->redirect(['site/login']);
        }

        // Obter o ID do cliente atualmente logado
        $clienteId = Yii::$app->user->identity->id;

        // Obter a reserva associada, ou criar uma nova se não existir
        $reserva = Reserva::findOne(['cliente_id' => $clienteId, 'fornecedor_id' => $fornecedorId]);

        if (!$reserva) {
            $reserva = new Reserva([
                'cliente_id' => $clienteId,
                'fornecedor_id' => $fornecedorId,
                'quantidade' => $quantidade,
                'preco' => $preco,
                'subtotal' => $linha->subtotal,
            ]);
            $reserva->save(); // Salvar a nova reserva
        }

        // Obter as linhas de reserva associadas à reserva
        $linhasReserva = $reserva->linhasreservas;

        // Inicializar subtotal do carrinho
        $subtotalCarrinho = 0;

        foreach ($linhasReserva as $linha) {
            // Obter valores da linha de reserva
            $quantidade = $linha->numeronoites; // Usar o campo numerodenoites como quantidade
            $preco = $linha->subtotal;

            // Verificar se o item já está no carrinho
            $carrinhoExistente = Carrinho::findOne(['cliente_id' => $clienteId, 'reserva_id' => $reserva->id, 'fornecedor_id' => $fornecedorId]);

            if ($carrinhoExistente) {
                // Atualizar a quantidade se o item já estiver no carrinho
                $carrinhoExistente->quantidade += $quantidade;
                $carrinhoExistente->subtotal = $carrinhoExistente->quantidade * $carrinhoExistente->preco;
                $carrinhoExistente->save();
            } else {
                // Adicionar um novo item ao carrinho
                $carrinhoNovo = new Carrinho([
                    'cliente_id' => $clienteId,
                    'reserva_id' => $reserva->id,
                    'fornecedor_id' => $fornecedorId,
                    'quantidade' => $quantidade,
                    'preco' => $preco,
                    'subtotal' => $linha->subtotal, // Usar o subtotal da linha de reserva como subtotal do carrinho
                ]);
                $carrinhoNovo->save();
            }

            // Adicionar ao subtotal total do carrinho
            $subtotalCarrinho += $linha->subtotal;
        }

        // Atualizar o subtotal do carrinho para todos os itens
        Carrinho::updateAll(['subtotal' => $subtotalCarrinho], ['cliente_id' => $clienteId]);

        return $this->redirect(Yii::$app->request->referrer ?: ['site/index']);
    }

    public function actionRemover($fornecedorId)
    {

    }



}
