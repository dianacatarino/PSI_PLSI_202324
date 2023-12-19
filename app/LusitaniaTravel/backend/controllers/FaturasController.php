<?php

namespace backend\controllers;

use backend\models\Fatura;
use backend\models\Linhasfatura;
use backend\models\Empresa;
use common\models\Reserva;
use Yii;
use yii\web\NotFoundHttpException;

class FaturasController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $faturas = Fatura::find()->all();

        return $this->render('index', ['faturas' => $faturas]);
    }

    public function actionCreate2()
    {
        $fatura = new Fatura();


        if ($fatura->load(Yii::$app->request->post())) {

            $reservaId = Yii::$app->request->post('Fatura')['reserva_id'];
            $fatura->reserva_id = $reservaId;

            if ($fatura->save()) {
                Yii::$app->session->setFlash('success', 'Fatura criada com sucesso.');
                return $this->redirect(['faturas/show', 'id' => $fatura->id]);
            } else {
                Yii::$app->session->setFlash('error', 'Erro ao criar a fatura.');
            }
        }

        return $this->render('create2', ['fatura' => $fatura]);
    }


    public function actionEdit($reserva_id)
    {
        $fatura = Fatura::findOne($reserva_id);

        // Lógica para editar uma reserva (pode envolver o uso de um formulário)

        if ($fatura->load(Yii::$app->request->post()) && $fatura->save()) {
            Yii::$app->session->setFlash('success', 'Fatura atualizada com sucesso.');
            return $this->redirect(['index']);
        }

        return $this->render('edit', ['fatura' => $fatura]);
    }


    public function actionShow($id)
    {
        $fatura = new Fatura();
        $id = Yii::$app->request->post('Fatura')['reserva_id'];
        $reserva = Reserva::findOne($id);

        if ($reserva) {
            $fatura->reserva_id = $id;

        } else {
            Yii::$app->session->setFlash('error', 'Erro ao encontrar a resserva.');
        }

        return $this->render('show', ['fatura' => $fatura]);
    }


    public function actionDelete($id)
    {
        $fatura = Fatura::findOne($id);

        // Lógica para excluir uma fatura

        $fatura->delete();
        Yii::$app->session->setFlash('success', 'Fatura apagada com sucesso.');

        return $this->redirect(['index']);
    }
}
