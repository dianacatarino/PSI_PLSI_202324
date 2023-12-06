<?php

namespace backend\controllers;

use app\models\Reserva;
use backend\models\Linhasreserva;
use DateTime;
use Yii;
use yii\web\NotFoundHttpException;

class LinhasreservasController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $linhasReservas = Linhasreserva::find()->all();

        return $this->render('index', [
            'linhasReservas' => $linhasReservas,
        ]);
    }

    public function calcularNumeroCamas($tipoquarto)
    {
        $mapaCamas = [
            'Quarto Individual' => 1,
            'Quarto Duplo' => 2,
            'Quarto Triplo' => 3,
            'Quarto Familiar' => 4,
            'Villa' => 6,
            'Suite' => 2,
        ];

        return isset($mapaCamas[$tipoquarto]) ? $mapaCamas[$tipoquarto] : 1;
    }


    public function actionCreate($reservas_id)
    {
        $linhasreserva = new Linhasreserva();

        // Obter a reserva
        $reserva = Reserva::findOne($reservas_id);

        if ($linhasreserva->load(Yii::$app->request->post())) {
            // Atribui as datas de check-in e check-out ao modelo Linhasreserva
            $linhasreserva->checkin = $reserva->checkin;
            $linhasreserva->checkout = $reserva->checkout;

            // Chama o método para calcular o número de noites
            $linhasreserva->numeronoites = $linhasreserva->calcularNoites($reserva);
            $linhasreserva->numerocamas = $this->calcularNumeroCamas($linhasreserva->tipoquarto);

            if ($linhasreserva->save()) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'linhasreserva' => $linhasreserva,
            'reserva' => $reserva, // Adicione esta linha para passar $reserva para a visão
            'reservas_id' => $reservas_id,
        ]);
    }

    public function actionEdit($id)
    {
        $model = Linhasreserva::findOne($id);

        if ($model === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('edit', [
            'model' => $model,
        ]);
    }

    public function actionShow($id)
    {
        $model = Linhasreserva::findOne($id);

        if ($model === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        return $this->render('show', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $model = Linhasreserva::findOne($id);

        if ($model === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $model->delete();

        return $this->redirect(['index']);
    }
}
