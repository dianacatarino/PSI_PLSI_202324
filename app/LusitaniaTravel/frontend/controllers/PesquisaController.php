<?php

namespace frontend\controllers;

use Yii;
use frontend\models\FornecedorSearch;
use yii\web\Controller;

class PesquisaController extends Controller
{
    public function actionIndex()
    {
        $fornecedorModel = new FornecedorSearch();
        $dataProvider = null;

        if ($fornecedorModel->load(Yii::$app->request->post()) && $fornecedorModel->validate()) {
            // Realizar a pesquisa no modelo FornecedorSearch
            $localizacao = $fornecedorModel->localizacao_alojamento;
            $dataProvider = $fornecedorModel->search(['FornecedorSearch' => ['localizacao_alojamento' => $localizacao]]);
        }

        return $this->render('index', [
            'fornecedorModel' => $fornecedorModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionResultados($localizacao_alojamento)
    {
        $fornecedorModel = new FornecedorSearch();
        $dataProvider = $fornecedorModel->search(['FornecedorSearch' => ['localizacao_alojamento' => $localizacao_alojamento]]);

        return $this->render('resultados', [
            'fornecedorModel' => $fornecedorModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
