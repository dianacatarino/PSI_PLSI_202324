<?php

namespace frontend\controllers;

use common\models\Confirmacao;
use common\models\Reserva;
use frontend\models\PesquisaForm;
use Yii;
use yii\web\Controller;
use common\models\Fornecedor;
use yii\data\ActiveDataProvider;

class PesquisaController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new PesquisaForm();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPesquisar()
    {
        $searchModel = new PesquisaForm();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionResultados()
    {

    }
}

