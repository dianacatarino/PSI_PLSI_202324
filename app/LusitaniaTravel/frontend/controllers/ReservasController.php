<?php

namespace frontend\controllers;

use common\models\Reserva;
use Yii;

class ReservasController extends \yii\web\Controller
{
    public function actionIndex()
    {
        // Obtenha o ID do usuário atualmente autenticado
        $userId = Yii::$app->user->id;

        // Busque as reservas associadas ao usuário atual
        $reservas = Reserva::find()->where(['cliente_id' => $userId])->all();

        return $this->render('index', ['reservas' => $reservas]);
    }

    public function actionShow($id)
    {
        $reserva = Reserva::findOne($id);

        return $this->render('show', ['reserva' => $reserva]);
    }
}
