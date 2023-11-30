<?php

namespace backend\controllers;

use backend\models\Linhasreserva;
use Yii;
use yii\web\NotFoundHttpException;

class LinhasreservasController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $linhasreservas = Linhasreserva::find()->all();

        return $this->render('index', ['linhasreservas' => $linhasreservas]);
    }

    public function actionCreate()
    {
        $linhasreserva = new Linhasreserva();

        if ($linhasreserva->load(Yii::$app->request->post()) && $linhasreserva->save()) {

            return $this->redirect(['index']);
        }

        return $this->render('create', ['linhasreserva' => $linhasreserva]);
    }

    public function actionStore()
    {
        $linhasreserva = new Linhasreserva();

        if ($linhasreserva->load(Yii::$app->request->post()) && $linhasreserva->save()) {
            return $this->redirect(['index']);
        }
        return $this->render('create', ['linhasreserva' => $linhasreserva]);
    }

    public function actionEdit($id)
    {
        $linhasreserva = Linhasreserva::findOne($id);

        if (!$linhasreserva) {
            throw new NotFoundHttpException('A reserva não foi encontrada!');
        }

        if ($linhasreserva->load(Yii::$app->request->post()) && $linhasreserva->save()) {
            return $this->redirect(['linhasreserva/index']);
        }

        return $this->render('edit', [
            'linhasreserva' => $linhasreserva,
        ]);
    }

    public function actionUpdate($id)
    {
        $linhasreserva = Linhasreserva::findOne($id);

        if (!$linhasreserva) {
            throw new NotFoundHttpException('A reserva não foi encontrada!');
        }

        if ($linhasreserva->load(Yii::$app->request->post()) && $linhasreserva->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', ['linhasreserva' => $linhasreserva]);
    }

    public function actionShow($id)
    {
        $linhasreserva = Linhasreserva::findOne($id);

        if (!$linhasreserva) {
            throw new NotFoundHttpException('A reserva não foi encontrada!');
        }
        return $this->render('show', ['linhasreserva' => $linhasreserva]);
    }

    public function actionDelete($id)
    {
        $linhasreserva = Linhasreserva::findOne($id);

        if (!$linhasreserva) {
            throw new NotFoundHttpException('A reserva não foi encontrada!');
        }

        $linhasreserva->delete();

        return $this->redirect(['index'], ['linhasreserva' => $linhasreserva]);
    }

    /*public function selectreserva($reserva_id)
    {
        $reservas = Reserva::all();
        $fatura = Fatura::find($reserva_id);
        $cliente_id = $fatura->$cliente_id;

        $this->renderView('linhasfatura', 'selectreserva', ['reservas' => $reservas, 'fatura_id' => $reserva_id, '$cliente_id' => $cliente_id]);
    }*/
}
