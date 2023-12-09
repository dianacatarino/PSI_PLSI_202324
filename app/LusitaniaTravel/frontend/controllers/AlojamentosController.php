<?php

namespace frontend\controllers;
use common\models\Fornecedor;
use common\models\Linhasreserva;
use common\models\Reserva;
use yii\web\NotFoundHttpException;

class AlojamentosController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $fornecedores = Fornecedor::find()->with('imagens')->all();

        return $this->render('index', ['fornecedores' => $fornecedores]);
    }

    public function actionShow($id)
    {
        $fornecedor = Fornecedor::findOne($id);

        if ($fornecedor === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        // Busca a última reserva associada ao fornecedor
        $reserva = Reserva::find()
            ->where(['fornecedor_id' => $fornecedor->id])
            ->orderBy(['checkout' => SORT_DESC])
            ->one();

        // Inicializa as variáveis
        $numeroQuartos = 0;
        $numeroCamas = 0;
        $precoPorNoite = 0;
        $tipoQuarto = ''; // Adiciona esta variável para armazenar o tipo de quarto

        // Se houver uma reserva, busca informações relevantes
        if ($reserva !== null) {
            $numeroQuartos = $reserva->numeroquartos;

            // Busca a última linha de reserva associada à reserva
            $ultimaLinhaReserva = LinhasReserva::find()
                ->where(['reservas_id' => $reserva->id])
                ->orderBy(['id' => SORT_DESC])
                ->one();

            if ($ultimaLinhaReserva !== null) {
                $numeroCamas = $ultimaLinhaReserva->numerocamas;
                $precoPorNoite = $ultimaLinhaReserva->subtotal; // Use o campo correto da sua tabela
                $tipoQuarto = $ultimaLinhaReserva->tipoquarto; // Adiciona esta linha para obter o tipo de quarto
            }
        }

        return $this->render('show', [
            'fornecedor' => $fornecedor,
            'numeroQuartos' => $numeroQuartos,
            'numeroCamas' => $numeroCamas,
            'precoPorNoite' => $precoPorNoite,
            'tipoQuarto' => $tipoQuarto, // Passa a variável para a view
        ]);
    }

}
