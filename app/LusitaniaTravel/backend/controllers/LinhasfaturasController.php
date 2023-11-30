<?php

namespace backend\controllers;

use backend\models\Linhasfatura;
use Yii;
use yii\web\NotFoundHttpException;

class LinhasfaturasController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $linhasfaturas = Linhasfatura::find()->all();

        return $this->render('index', ['linhasfaturas' => $linhasfaturas]);

    }

    public function actionCreate()
    {
        $linhasfatura = new Linhasfatura();

        if ($linhasfatura->load(Yii::$app->request->post()) && $linhasfatura->save()) {

            return $this->redirect(['index']);
        }

        return $this->render('create', ['linhasfatura' => $linhasfatura]);
    }

    public function actionStore()
    {
        $linhasfatura = new Linhasfatura();

        if ($linhasfatura->load(Yii::$app->request->post()) && $linhasfatura->save()) {
            return $this->redirect(['index']);
        }
        return $this->render('create', ['linhasfatura' => $linhasfatura]);

    }

    public function actionEdit($id)
    {
        $linhasfatura = Linhasfatura::findOne($id);

        if (!$linhasfatura) {
            throw new NotFoundHttpException('A fatura não foi encontrada!');
        }

        if ($linhasfatura->load(Yii::$app->request->post()) && $linhasfatura->save()) {
            return $this->redirect(['linhasfatura/index']);
        }

        return $this->render('edit', [
            'linhasfatura' => $linhasfatura,
        ]);
    }

    public function actionUpdate($id)
    {
        $linhasfatura = Linhasfatura::findOne($id);

        if (!$linhasfatura) {
            throw new NotFoundHttpException('A fatura não foi encontrada!');
        }

        if ($linhasfatura->load(Yii::$app->request->post()) && $linhasfatura->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', ['linhasfatura' => $linhasfatura]);
    }

    public function actionShow($id)
    {
        $linhasfatura = Linhasfatura::findOne($id);

        if (!$linhasfatura) {
            throw new NotFoundHttpException('A fatura não foi encontrada!');
        }
        return $this->render('show', ['linhasfatura' => $linhasfatura]);
    }

    public function actionDelete()
    {
        $linhasfatura = Linhasfatura::findOne($id);

        if (!$linhasfatura) {
            throw new NotFoundHttpException('A fatura não foi encontrada!');
        }

        $linhasfatura->delete();

        return $this->redirect(['index'], ['linhasfatura' => $linhasfatura]);
    }

    /*public function selectfatura($reserva_id) , TODO: função a implmentar para seleção
    {
        $reservas = Reserva::all();
        $fatura = Fatura::find($reserva_id);
        $cliente_id = $fatura->$cliente_id;

        $this->renderView('linhasfatura', 'selectreserva', ['reservas' => $reservas, 'fatura_id' => $reserva_id, '$cliente_id' => $cliente_id]);
    }*/

}