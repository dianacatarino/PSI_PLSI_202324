<?php

namespace backend\controllers;

use backend\models\Empresa;
use common\models\Fatura;
use common\models\Linhasfatura;
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

    public function actionCreate()
    {
        $fatura = new Fatura();
        $linhafatura = new Linhasfatura();
        $empresa = Empresa::findOne(1);

        if ($fatura->load(Yii::$app->request->post())) {
            if ($fatura->save()) {
                Yii::$app->session->setFlash('success', 'Fatura criada com sucesso.');
                return $this->redirect(['index']);
            } else {
                Yii::error('Error saving fatura to database.');
                Yii::error($fatura->errors);
            }
        }

        return $this->render('create', [
            'fatura' => $fatura,
            'empresa' => $empresa,
            'linhafatura' => $linhafatura,
            'selectClientes' => $fatura->selectClientes(),
            'selectReservas' => $fatura->selectReservas(),
        ]);
    }


    public function actionEdit($id)
    {
        $fatura = Fatura::findOne($id);

        // Lógica para editar uma reserva (pode envolver o uso de um formulário)

        if ($fatura->load(Yii::$app->request->post()) && $fatura->save()) {
            Yii::$app->session->setFlash('success', 'Fatura atualizada com sucesso.');
            return $this->redirect(['index']);
        }

        return $this->render('edit', ['fatura' => $fatura]);
    }


    public function actionShow($id)
    {
        $fatura = Reserva::findOne($id);

        if (!$fatura) {
            throw new NotFoundHttpException('A fatura não foi encontrada.');
        }

        return $this->render('show', ['fatura' => $fatura]);
    }

    public function actionDelete($id)
    {
        $fatura = Fatura::findOne($id);

        // Lógica para excluir uma reserva

        $fatura->delete();
        Yii::$app->session->setFlash('success', 'Fatura excluída com sucesso.');

        return $this->redirect(['index']);
    }
}
