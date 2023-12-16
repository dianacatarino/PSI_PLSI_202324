<?php

namespace frontend\controllers;

use common\models\Fatura;
use yii\web\NotFoundHttpException;

class FaturasController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $faturas = Fatura::find()->all();

        return $this->render('index', ['faturas' => $faturas]);
    }

    public function actionShow($id)
    {
        $fatura = Fatura::findOne($id);

        if ($fatura === null) {
            throw new NotFoundHttpException('Fatura não encontrada.');
        }

        return $this->render('show', ['fatura' => $fatura]);
    }


}
