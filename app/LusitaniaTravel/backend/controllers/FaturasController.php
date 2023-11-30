<?php

namespace backend\controllers;

use backend\models\Fatura;
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

        if ($fatura->load(Yii::$app->request->post()) && $fatura->save()) {

            return $this->redirect(['index']);
        }

        return $this->render('create', ['fatura' => $fatura]);
    }

    public function actionStore()
    {
        $fatura = new Fatura();

        if ($fatura->load(Yii::$app->request->post()) && $fatura->save()) {
            return $this->redirect(['index']);
        }
        return $this->render('create', ['fatura' => $fatura]);
    }

    public function actionEdit($id)
    {
        $fatura = Fatura::findOne($id);

        if (!$fatura) {
            throw new NotFoundHttpException('A fatura não foi encontrada!');
        }

        if ($fatura->load(Yii::$app->request->post()) && $fatura->save()) {
            return $this->redirect(['fatura/index']);
        }

        return $this->render('edit', [
            'fatura' => $fatura,
        ]);
    }

    public function actionUpdate($id)
    {
        $fatura = Fatura::findOne($id);

        if (!$fatura) {
            throw new NotFoundHttpException('A fatura não foi encontrada!');
        }

        if ($fatura->load(Yii::$app->request->post()) && $fatura->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', ['fatura' => $fatura]);
    }

    public function actionShow($id)
    {
        $fatura = Fatura::findOne($id);

        if (!$fatura) {
            throw new NotFoundHttpException('A fatura não foi encontrada!');
        }
        return $this->render('show', ['fatura' => $fatura]);
    }

    public function actionDelete($id)
    {
        $fatura = Fatura::findOne($id);

        if (!$fatura) {
            throw new NotFoundHttpException('A fatura não foi encontrada!');
        }

        $fatura->delete();

        return $this->redirect(['index'], ['fatura' => $fatura]);
    }
}
