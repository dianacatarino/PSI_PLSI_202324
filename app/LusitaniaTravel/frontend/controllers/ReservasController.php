<?php

namespace frontend\controllers;

use common\models\Reserva;
use Yii;
use yii\web\NotFoundHttpException;

class ReservasController extends \yii\web\Controller
{
    public function actionIndex()
    {
        // Obtenha o ID do usuário atualmente autenticado
        $userId = Yii::$app->user->id;

        // Busque as reservas associadas ao usuário atual
        $reservas = Reserva::find()->with('confirmacoes')->where(['cliente_id' => $userId])->all();

        return $this->render('index', ['reservas' => $reservas]);
    }

    public function actionShow($id)
    {
        $reserva = Reserva::find()->with('linhasreservas')->where(['id' => $id])->one();

        // Verifique se a reserva foi encontrada
        if ($reserva === null) {
            throw new NotFoundHttpException('A reserva não foi encontrada.');
        }

        return $this->render('show', ['reserva' => $reserva]);
    }
}
