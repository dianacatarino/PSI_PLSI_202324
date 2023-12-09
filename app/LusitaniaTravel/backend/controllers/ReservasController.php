<?php

namespace backend\controllers;

use common\models\Reserva;
use common\models\Linhasreserva;
use Yii;
use yii\web\NotFoundHttpException;

class ReservasController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $reservas = Reserva::find()->with('linhasreservas')->all();

        return $this->render('index', ['reservas' => $reservas]);
    }

    public function actionCreate()
    {
        $reserva = new Reserva();
        $linhareserva = new Linhasreserva();

        if ($reserva->load(Yii::$app->request->post())) {
            if ($reserva->save()) {
                Yii::$app->session->setFlash('success', 'Reserva criada com sucesso.');
                return $this->redirect(['index']);
            } else {
                Yii::error('Error saving reserva to database.');
                Yii::error($reserva->errors);
            }
        }

        return $this->render('create', ['reserva' => $reserva,
        'selectAlojamentos' => $reserva->selectAlojamentos(),
        'selectClientes' => $reserva->selectClientes(),
        'selectFuncionarios' => $reserva->selectFuncionarios()]);
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

        // Lógica para excluir uma reserva

        $reserva->delete();
        Yii::$app->session->setFlash('success', 'Reserva excluída com sucesso.');

        return $this->redirect(['index']);
    }
}