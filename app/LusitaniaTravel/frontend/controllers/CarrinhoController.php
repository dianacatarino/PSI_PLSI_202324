<?php

namespace frontend\controllers;

use common\models\Confirmacao;
use common\models\Fatura;
use common\models\Fornecedor;
use common\models\Linhasfatura;
use common\models\Linhasreserva;
use common\models\Prestacao;
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

    public function actionPagamento($id)
    {
        $reserva = Reserva::findOne($id);

        if ($reserva === null) {
            throw new NotFoundHttpException('Reserva não encontrada.');
        }

        $clienteId = Yii::$app->user->id;

        // Lógica para limpar os itens do carrinho associados ao cliente
        $itensCarrinho = Carrinho::findAll(['cliente_id' => $clienteId]);

        foreach ($itensCarrinho as $item) {
            $item->delete();
        }

        // Lógica para criar a fatura e as linhas de fatura
        $fatura = new Fatura();
        $fatura->totalf = $reserva->valor; // ou qualquer outra lógica de cálculo para o total da fatura
        $fatura->totalsi = $reserva->valor - 0.23; // ou qualquer outra lógica de cálculo para o total da fatura
        $fatura->iva = 0.23; // por exemplo, 23% de IVA
        $fatura->empresa_id = 1; // substitua pelo ID real da empresa
        $fatura->reserva_id = $reserva->id; // associar à reserva
        $fatura->data = date('Y-m-d'); // data atual
        $fatura->save();

        // Buscar as LinhasReservas associadas à reserva
        $linhasReservas = LinhasReserva::findAll(['reservas_id' => $reserva->id]);

        // Para cada item no carrinho, criar uma linha de fatura (LinhasFaturas)
        foreach ($itensCarrinho as $item) {
            $linhaFatura = new LinhasFatura();
            $linhaFatura->quantidade = count($linhasReservas); // Quantidade é a contagem de LinhasReservas
            $linhaFatura->precounitario = $item->preco; // ou qualquer outra lógica para o preço unitário
            $linhaFatura->subtotal = $item->subtotal;
            $linhaFatura->iva = 0.23; // por exemplo, 23% de IVA
            $linhaFatura->fatura_id = $fatura->id; // associar à fatura

            // Associar a cada LinhasReservas
            foreach ($linhasReservas as $linhaReserva) {
                $linhaFatura->link('linhasreservas', $linhaReserva);
            }

            $linhaFatura->save();
        }

        return $this->render('pagamento', [
            'reserva' => $reserva,
            'fatura' => $fatura,
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
