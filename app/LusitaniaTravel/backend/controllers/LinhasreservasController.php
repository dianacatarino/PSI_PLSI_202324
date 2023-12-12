<?php

namespace backend\controllers;

use common\models\Linhasfatura;
use common\models\Reserva;
use common\models\Linhasreserva;
use DateTime;
use Yii;
use yii\web\NotFoundHttpException;

class LinhasreservasController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $linhasreservas = Linhasreserva::find()->all();

        return $this->render('index', [
            'linhasreservas' => $linhasreservas,
        ]);
    }


    public function actionCreate($reservas_id)
    {
        $linhasreserva = new Linhasreserva();
        $linhasfatura = new Linhasfatura();

        // Obter a reserva
        $reserva = Reserva::findOne($reservas_id);

        if ($linhasreserva->load(Yii::$app->request->post())) {
            // Chama o método para calcular o número de noites
            $linhasreserva->numeronoites = $linhasreserva->calcularNoites($reserva);
            $linhasreserva->numerocamas = $linhasreserva->calcularNumeroCamas($linhasreserva->tipoquarto);
            $linhasreserva->subtotal = $linhasreserva->calcularSubtotal($reserva);
            $linhasreserva->reservas_id = $reservas_id;

            if ($linhasreserva->save()) {
                // Configurar propriedades da linha de fatura
                $linhasfatura->linhasreserva_id = $linhasreserva->id;
                $linhasfatura->quantidade = $linhasreserva->numeronoites;
                $linhasfatura->precounitario = $reserva->valor;
                $linhasfatura->subtotal = $linhasreserva->subtotal;
                $linhasfatura->iva = $linhasfatura->calcularIva($linhasfatura->subtotal);

                // Salvar linha de fatura
                if ($linhasfatura->save()) {
                    return $this->redirect(['reservas/index']);
                } else {
                    Yii::error('Erro ao salvar a linha de fatura.');
                    Yii::error($linhasfatura->errors);
                }
            } else {
                Yii::error('Erro ao salvar a linha de reserva.');
                Yii::error($linhasreserva->errors);
            }
        }

        return $this->render('create', [
            'linhasreserva' => $linhasreserva,
            'linhasfatura' => $linhasfatura,
            'reserva' => $reserva,
            'reservas_id' => $reservas_id,
        ]);
    }

    public function actionEdit($id)
    {
        $linhasreserva = Linhasreserva::findOne($id);

        if ($linhasreserva === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        // Obtenha a reserva relacionada à linha de reserva
        $reserva = $linhasreserva->reservas;

        if ($linhasreserva->load(Yii::$app->request->post())) {
            // Chame os métodos para calcular os campos necessários
            $linhasreserva->numeronoites = $linhasreserva->calcularNoites($reserva);
            $linhasreserva->numerocamas = $linhasreserva->calcularNumeroCamas($linhasreserva->tipoquarto);
            $linhasreserva->subtotal = $linhasreserva->calcularSubtotal($reserva);

            if ($linhasreserva->save()) {
                return $this->redirect(['reservas/index']);
            }
        }

        return $this->render('edit', [
            'linhasreserva' => $linhasreserva,
            'reserva' => $reserva,
        ]);
    }

    public function actionShow($id)
    {
        $linhasreserva = Linhasreserva::findOne($id);

        if ($linhasreserva === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        return $this->render('show', [
            'linhasreserva' => $linhasreserva,
        ]);
    }

    public function actionDelete($id)
    {
        $linhasreserva = Linhasreserva::findOne($id);

        if ($linhasreserva === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $linhasreserva->delete();

        return $this->redirect(['reservas/index']);
    }
}
