<?php

namespace frontend\controllers;

use common\models\Fornecedor;
use common\models\Linhasreserva;
use common\models\Reserva;
use DateTime;
use frontend\models\Carrinho;
use Yii;
use yii\web\NotFoundHttpException;

class ReservasController extends \yii\web\Controller
{
    public function actionIndex()
    {
        // Obtenha o ID do usuário atualmente autenticado
        $userId = Yii::$app->user->id;

        // Busque as reservas associadas ao usuário atual
        $reservas = Reserva::find()->with('confirmacoes')->where(['cliente_id' => $userId])->all();

        return $this->render('index', ['reservas' => $reservas]);
    }

    public function actionVerificar()
    {
        // Obtenha o ID da reserva do formulário
        $reservaId = Yii::$app->request->post('reservaId');

        // Verifique se a reservaId está presente no POST
        if ($reservaId === null) {
            // A reservaId não foi fornecida, adicione uma mensagem de erro
            Yii::$app->session->setFlash('error', 'A reserva não foi encontrada.');

            // Redirecione de volta para o carrinho
            return $this->redirect(['carrinho/index']);
        }

        // Obtenha a reserva com base no ID fornecido
        $reserva = Reserva::findOne($reservaId);

        // Verifique se a reserva foi encontrada
        if ($reserva === null) {
            // A reserva não foi encontrada, adicione uma mensagem de erro
            Yii::$app->session->setFlash('error', 'A reserva não foi encontrada.');

            // Redirecione de volta para o carrinho
            return $this->redirect(['carrinho/index']);
        }

        // Verifique os itens do carrinho relacionados à reserva
        $itensCarrinho = Carrinho::find()->where(['reserva_id' => $reservaId])->all();

        // Verifique se o formulário foi enviado e carregue os dados do post
        if ($reserva->load(Yii::$app->request->post()) && $reserva->save()) {
            // Calcular o valor total com base nas datas de check-in e check-out
            $checkin = new \DateTime($reserva->checkin);
            $checkout = new \DateTime($reserva->checkout);
            $diasReserva = $checkout->diff($checkin)->days;

            // Verifique os itens do carrinho relacionados à reserva
            $itensCarrinho = Carrinho::find()->where(['reserva_id' => $reservaId])->all();

            // Calcular o valor total
            $total = 0;
            foreach ($itensCarrinho as $item) {
                // Adicione a lógica do seu cálculo aqui
                $total += $diasReserva * $item->fornecedor->precopornoite;

                // Adicione o subtotal do carrinho multiplicado pelo número de linhasreservas ao total
                $total += $item->subtotal * count($reserva->linhasreservas);

                // Atribuir o subtotal multiplicado ao item do carrinho
                $item->subtotal = $item->subtotal + $diasReserva * $item->fornecedor->precopornoite;
                $item->save(); // Salvar as alterações no banco de dados
            }

            // Atribuir o valor calculado à propriedade valor do modelo Reserva
            $reserva->valor = $total;

            // Salvar a reserva com o novo valor
            if ($reserva->save()) {
                // Criar instâncias de LinhaReserva com base no número de quartos
                for ($i = 0; $i < $reserva->numeroquartos; $i++) {
                    $linhareserva = new Linhasreserva();
                    $linhareserva->reservas_id = $reservaId;

                    $postData = Yii::$app->request->post("Reserva") ?? [];
                    $reservaData = $postData['linhasreservas'][$reservaId] ?? [];

                    $tipoQuartoPost = $reservaData['tipoquarto'][1];
                    $numeroCamasPost = $reservaData['numerocamas'][1];

                    $linhareserva = new Linhasreserva();
                    $linhareserva->reservas_id = $reservaId;
                    $linhareserva->tipoquarto = $tipoQuartoPost;
                    $linhareserva->numeronoites = $diasReserva;
                    $linhareserva->numerocamas = $numeroCamasPost;
                    $linhareserva->subtotal = $reserva->valor / $diasReserva;
                    $linhareserva->save();
                }

                // Verificação bem-sucedida, redirecione para a página de índice de reservas
                Yii::$app->session->setFlash('success', 'Verificação bem-sucedida!');
                return $this->redirect(['reservas/index']);
            } else {
                // Falha ao salvar a reserva, adicione uma mensagem de erro
                Yii::$app->session->setFlash('error', 'Falha na verificação. Não foi possível salvar a reserva.');
            }
        }

        // Redirecione de volta para o carrinho
        return $this->redirect(['carrinho/index']);
    }


    public function actionShow($id)
    {
        $reserva = Reserva::find()->with('linhasreservas')->where(['id' => $id])->one();

        // Verifique se a reserva foi encontrada
        if ($reserva === null) {
            throw new NotFoundHttpException('A reserva não foi encontrada.');
        }

        return $this->render('show', ['reserva' => $reserva]);
    }
}
