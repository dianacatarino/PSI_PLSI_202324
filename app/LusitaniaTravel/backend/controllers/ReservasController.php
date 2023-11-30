<?php

namespace backend\controllers;

use backend\models\Reserva;
use Yii;
use yii\web\NotFoundHttpException;

class ReservasController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $reservas = Reserva::find()->all();

        return $this->render('index', ['reservas' => $reservas]);
    }

    public function actionCreate()
    {
        $reserva = new Reserva();

        if ($reserva->load(Yii::$app->request->post()) && $reserva->save()) {

            return $this->redirect(['index']);
        }

        return $this->render('create', ['reserva' => $reserva]);
    }

    public function actionStore()
    {
        $reserva = new Reserva();

        if ($reserva->load(Yii::$app->request->post()) && $reserva->save()) {
            return $this->redirect(['index']);
        }
        return $this->render('create', ['reserva' => $reserva]);
    }

    public function actionEdit($id)
    {
        $reserva = Reserva::findOne($id);

        if (!$reserva) {
            throw new NotFoundHttpException('A reserva não foi encontrada!');
        }

        if ($reserva->load(Yii::$app->request->post()) && $reserva->save()) {
            return $this->redirect(['reserva/index']);
        }

        return $this->render('edit', [
            'reserva' => $reserva,
        ]);
    }

    public function actionUpdate($id)
    {
        $reserva = Reserva::findOne($id);

        if (!$reserva) {
            throw new NotFoundHttpException('A reserva não foi encontrada!');
        }

        if ($reserva->load(Yii::$app->request->post()) && $reserva->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', ['reserva' => $reserva]);
    }

    public function actionShow($id)
    {
        $reserva = Reserva::findOne($id);

        if (!$reserva) {
            throw new NotFoundHttpException('A reserva não foi encontrada!');
        }
        return $this->render('show', ['reserva' => $reserva]);
    }


    public function actionDelete($id)
    {
        $reserva = Reserva::findOne($id);

        if (!$reserva) {
            throw new NotFoundHttpException('A reserva não foi encontrada!');
        }

        $reserva->delete();

        return $this->redirect(['index'], ['reserva' => $reserva]);
    }
}