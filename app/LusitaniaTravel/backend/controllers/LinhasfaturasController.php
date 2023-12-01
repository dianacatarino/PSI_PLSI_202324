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
        return $this->render('create');
    }

    public function actionStore()
    {
        return $this->render('store');
    }

    public function actionEdit()
    {
        return $this->render('edit');
    }

    public function actionUpdate()
    {
        return $this->render('update');
    }

    public function actionShow($id)
    {
        return $this->render('show');
    }

    public function actionDelete()
    {
        return $this->render('delete');
    }
}