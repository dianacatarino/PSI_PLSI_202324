<?php

namespace backend\controllers;

use backend\models\Fornecedor;
use Yii;
use yii\web\NotFoundHttpException;

class AlojamentosController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
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

    public function actionShow()
    {
        return $this->render('show');
    }

    public function actionDelete()
    {
        return $this->render('delete');
    }
}
