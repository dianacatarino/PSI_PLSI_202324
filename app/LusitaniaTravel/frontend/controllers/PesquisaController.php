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
        $fornecedores = Fornecedor::find()->all();
        return $this->render('index', ['fornecedores' => $fornecedores]);
    }

    public function actionSearch()
    {
        $searchModel = new PesquisaForm();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('search', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}

