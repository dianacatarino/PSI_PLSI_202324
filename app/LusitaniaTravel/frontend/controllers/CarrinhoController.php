<?php

namespace frontend\controllers;

use common\models\Confirmacao;
use common\models\Fatura;
use common\models\Fornecedor;
use common\models\Linhasfatura;
use common\models\Linhasreserva;
use common\models\Reserva;
use common\models\User;
use frontend\models\Carrinho;
use Mpdf\Mpdf;
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

        // Obtém o ID do fornecedor da requisição
        $fornecedorId = Yii::$app->request->get('fornecedorId');

        // Obtém o fornecedor com base no ID
        $fornecedor = Fornecedor::findOne($fornecedorId);

        // Verifica se o fornecedor foi encontrado
        if ($fornecedor === null) {
            // Lógica para lidar com o fornecedor não encontrado (pode ser um redirecionamento ou uma mensagem de erro)
        }

        $reserva = new Reserva();

        return $this->render('index', [
            'itensCarrinho' => $itensCarrinho,
            'totalCarrinho' => $totalCarrinho,
            'reserva' => $reserva,
            'selecionarReserva' => $selecionarReserva,
            'fornecedor' => $fornecedor,
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
            'subtotal' => 0,
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

        // Calcular o valor total com base nos itens do carrinho
        $valorTotal = 0;
        foreach ($itensCarrinho as $item) {
            // Adicione a lógica do seu cálculo aqui
            $valorTotal += $item->subtotal;
        }

        // Criar a entidade de Reserva
        $reserva = new Reserva();
        $reserva->valor = $valorTotal;
        $reserva->entidade = 21223; // Valor fixo
        $reserva->save();

        // Associar a referência à entidade (usando o ID da reserva como referência)
        $referencia = 'REF' . str_pad($reserva->id, 8, '0', STR_PAD_LEFT);
        $reserva->referencia = $referencia;
        $reserva->save();

        // Cria a fatura associada à reserva
        $fatura = new Fatura([
            'totalf' => $reserva->valor,
            'totalsi' => $reserva->valor - 0.23, // Ajuste conforme necessário
            'iva' => 0.23, // Substitua 0.23 pela taxa de IVA apropriada
            'empresa_id' => 1, // Substitua 1 pelo ID da empresa associada à fatura
            'reserva_id' => $reserva->id,
        ]);

        // Salva a fatura
        if (!$fatura->save()) {
            Yii::error('Erro ao salvar a fatura: ' . print_r($fatura->errors, true));
            throw new \Exception('Erro ao salvar a fatura.');
        }

        // Cria linhas de fatura com base na reserva
        $linhaFatura = new Linhasfatura([
            'quantidade' => 1, // Ajuste conforme necessário
            'precounitario' => $reserva->valor, // Ajuste conforme necessário
            'subtotal' => $reserva->valor,
            'iva' => $reserva->valor * 0.23, // Substitua 0.23 pela taxa de IVA apropriada
            'fatura_id' => $fatura->id,
            'linhasreservas_id' => $reserva->id,
        ]);

        // Salva a linha de fatura
        if (!$linhaFatura->save()) {
            Yii::error('Erro ao salvar a linha de fatura: ' . print_r($linhaFatura->errors, true));
            throw new \Exception('Erro ao salvar a linha de fatura.');
        }

        // Criar linhas de fatura com base nos itens do carrinho
        foreach ($itensCarrinho as $item) {
            $linhaFatura = new Linhasfatura();
            $linhaFatura->quantidade = $item->quantidade;
            $linhaFatura->precounitario = $item->fornecedor->precopornoite; // Supondo que há uma relação entre ItemCarrinho e Produto
            $linhaFatura->subtotal = $item->subtotal;
            $linhaFatura->iva = $item->subtotal * 0.23; // Substitua 0.23 pela taxa de IVA apropriada
            $linhaFatura->fatura_id = $fatura->id;
            $linhaFatura->linhasreservas_id = $item->reserva->id; // Supondo que há uma relação entre ItemCarrinho e Reserva
            $linhaFatura->save();
        }

        // Remover itens do carrinho da base de dados
        foreach ($itensCarrinho as $item) {
            $item->delete();
        }

        // Limpar o carrinho (remover itens da sessão)
        Yii::$app->session->remove('carrinho');
        Yii::$app->session->remove('totalCarrinho');


        // Exibir mensagem de sucesso (você pode redirecionar para uma página de confirmação, por exemplo)
        Yii::$app->session->setFlash('success', 'Compra finalizada com sucesso!');

        // Redirecionar para a página desejada após a finalização da compra
        return $this->redirect(['site/pagamento', 'id' => $reserva->id]);
    }

    public function actionPagamento($id)
    {
        $reserva = Reserva::findOne($id);

        if ($reserva === null) {
            throw new NotFoundHttpException('Reserva não encontrada.');
        }

        return $this->render('pagamento', [
            'reserva' => $reserva,
        ]);
    }

    public function actionDownload($id)
    {
        // Buscar a reserva pelo ID fornecido
        $reserva = Reserva::findOne($id);

        // Verificar se a reserva foi encontrada
        if ($reserva === null) {
            throw new NotFoundHttpException('Reserva não encontrada.');
        }

        // Configurar a instância do TCPDF
        $mpdf = new Mpdf();

        // Adicionar conteúdo ao PDF
        $content = "
        <div style='text-align: center;'>
        <img src='/LusitaniaTravel/frontend/public/img/logo_vertical.png' alt='Logo' style='width: 200px; height: 200px;'>
        <p>Entidade: 21223</p>
        <p>Referência: REF" . str_pad($reserva->id, 8, '0', STR_PAD_LEFT) . "</p>
        <p>Valor: " . Yii::$app->formatter->asCurrency($reserva->valor, 'EUR') . "</p>
        </div>";

        $mpdf->WriteHTML($content);


        $filename = 'pagamento_' . $reserva->id . '.pdf';

        // Saída para o navegador
        $mpdf->Output($filename, 'D');

        // Encerrar a execução
        Yii::$app->end();
    }
}
