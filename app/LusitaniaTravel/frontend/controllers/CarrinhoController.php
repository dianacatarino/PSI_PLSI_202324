<?php

namespace frontend\controllers;

use common\models\Confirmacao;
use common\models\Fornecedor;
use common\models\Linhasreserva;
use common\models\Reserva;
use common\models\User;
use frontend\models\Carrinho;
use Yii;
use yii\web\NotFoundHttpException;

class CarrinhoController extends \yii\web\Controller
{

    public function actionIndex()
    {
        $clienteId = Yii::$app->user->id;

        // Obtém os itens do carrinho para o cliente atual
        $itensCarrinho = Carrinho::find()->where(['cliente_id' => $clienteId])->all();

        // Calcula o total do carrinho
        $totalCarrinho = 0;
        foreach ($itensCarrinho as $item) {
            $totalCarrinho += $item->subtotal;
        }

        // Obtém as reservas associadas aos itens do carrinho
        $selecionarReserva = [];
        foreach ($itensCarrinho as $item) {
            $selecionarReserva[] = $item->reserva_id;
        }

        // Crie uma instância de Reserva (substitua isso pela lógica real)
        $reserva = new Reserva();

        return $this->render('index', [
            'itensCarrinho' => $itensCarrinho,
            'totalCarrinho' => $totalCarrinho,
            'reserva' => $reserva,
            'selecionarReserva' => $selecionarReserva,
        ]);
    }

    public function actionAdicionar($fornecedorId)
    {
        $fornecedor = Fornecedor::findOne($fornecedorId);

        if ($fornecedor === null) {
            throw new NotFoundHttpException('O fornecedor não foi encontrado.');
        }

        $clienteId = Yii::$app->user->id;
        $funcionarioId = null;

        // Busca o ID do usuário admin pelo nome de usuário
        $adminUser = User::findOne(['username' => 'lusitaniatravel']);

        if ($adminUser !== null) {
            $funcionarioId = $adminUser->id;
        }

        // Cria uma nova reserva associada ao carrinho
        $reserva = new Reserva([
            'tipo' => 'Online',
            'checkin' => '0000-00-00',
            'checkout' => '0000-00-00',
            'numeroquartos' => 0,
            'numeroclientes' => 0,
            'valor' => 0,
            'cliente_id' => $clienteId,
            'fornecedor_id' => $fornecedorId,
            'funcionario_id' => $funcionarioId,
        ]);

        // Salva a reserva
        $reserva->save();

        // Obtém o ID da reserva recém-criada
        $reservaId = $reserva->id;

        // Cria uma nova confirmação associada à reserva com o estado "pendente"
        $confirmacao = new Confirmacao([
            'reserva_id' => $reservaId,
            'estado' => 'Pendente',
            'dataconfirmacao' => '0000-00-00',
            'fornecedor_id' => $fornecedorId,
        ]);

        // Salva a confirmação
        $confirmacao->save();

        // Cria um novo item no carrinho associado à reserva
        $carrinhoExistente = new Carrinho([
            'fornecedor_id' => $fornecedorId,
            'cliente_id' => $clienteId,
            'quantidade' => 1,
            'preco' => $fornecedor->precopornoite,
            'subtotal' => 0, // Você pode ajustar isso de acordo com a lógica desejada
            'reserva_id' => $reservaId,
        ]);

        // Salva o item no carrinho
        $carrinhoExistente->save();

        // Redireciona para a página do carrinho
        return $this->redirect(['carrinho/index']);
    }

    public function actionRemover($id)
    {
        // Obtenha o item do carrinho com base no ID
        $carrinhoItem = Carrinho::findOne($id);

        if ($carrinhoItem === null) {
            throw new NotFoundHttpException('Item do carrinho não encontrado.');
        }

        // Obtenha o ID da reserva associada ao item do carrinho
        $reservaId = $carrinhoItem->reserva_id;

        // Exclua o item do carrinho
        $carrinhoItem->delete();

        // Exclua a confirmação associada à reserva
        Confirmacao::deleteAll(['reserva_id' => $reservaId]);

        // Exclua a reserva
        Reserva::deleteAll(['id' => $reservaId]);

        // Redirecione de volta à página do carrinho
        return $this->redirect(['carrinho/index']);
    }

    public function actionFinalizarCompra()
    {
        // Obter os itens do carrinho
        $itensCarrinho = Yii::$app->session->get('carrinho', []);

        // Verificar o estado das reservas no carrinho
        foreach ($itensCarrinho as $item) {
            $confirmacoes = $item->reserva->confirmacoes;

            // Ajuste esta parte para corresponder à estrutura real do array de confirmações
            $ultimaConfirmacao = end($confirmacoes);

            if ($ultimaConfirmacao['estado'] === 'Pendente') {
                // Se o estado for pendente, não permitir a finalização da compra
                throw new NotFoundHttpException('Não é possível finalizar a compra. O estado da reserva está pendente.');
            } elseif ($ultimaConfirmacao['estado'] !== 'Confirmado') {
                // Se o estado não for confirmado ou pendente, não permitir a finalização da compra
                throw new NotFoundHttpException('Não é possível finalizar a compra. O estado da reserva não está confirmado.');
            }
        }

        // Limpar o carrinho (remover itens da sessão)
        Yii::$app->session->remove('carrinho');
        Yii::$app->session->remove('totalCarrinho');

        // Exibir mensagem de sucesso (você pode redirecionar para uma página de confirmação, por exemplo)
        Yii::$app->session->setFlash('success', 'Compra finalizada com sucesso!');

        // Redirecionar para a página desejada após a finalização da compra
        return $this->redirect(['site/index']);
    }
}
