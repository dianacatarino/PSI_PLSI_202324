<?php

namespace backend\controllers;

use common\models\Fatura;
use common\models\Linhasfatura;
use backend\models\Empresa;
use backend\models\ReservaSearch;
use common\models\Linhasreserva;
use common\models\Reserva;
use Yii;
use yii\web\NotFoundHttpException;

class FaturasController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $faturas = Fatura::find()->with('linhasfaturas')->all();

        return $this->render('index', ['faturas' => $faturas]);
    }

    public function actionCreate2()
    {
        $fatura = new Fatura();
        $reservaModel = new ReservaSearch();

        if ($reservaModel->load(Yii::$app->request->post()) && $reservaModel->validate()) {
            // Aqui você pode realizar qualquer ação necessária para a pesquisa, mas não use $dataProvider
        }

        if ($fatura->load(Yii::$app->request->post())) {
            $reservaId = Yii::$app->request->post('Fatura')['reserva_id'];
            $fatura->reserva_id = $reservaId;

            if ($fatura->save()) {
                Yii::$app->session->setFlash('success', 'Fatura criada com sucesso.');
                return $this->redirect(['faturas/show', 'id' => $fatura->id]);
            } else {
                Yii::$app->session->setFlash('error', 'Erro ao criar a fatura.');
            }
        }

        return $this->render('create2', [
            'fatura' => $fatura,
            'reservaModel' => $reservaModel,
            'selectReservas' => $fatura->selectReservas(),
        ]);
    }

    public function actionGetReservaInfo($id)
    {
        $reserva = Reserva::findOne($id);

        if ($reserva) {
            $info = [
                'fornecedor_nome_alojamento' => $reserva->fornecedor->nome_alojamento,
                'cliente_profile_name' => $reserva->cliente->profile->name,
            ];

            return json_encode($info);
        }

        return json_encode(['error' => 'Reserva não encontrada']);
    }


    public function actionCreate($reservaId)
    {
        // Find the reserva model
        $reservaModel = Reserva::findOne($reservaId);
        $iva = 0.23;

        if (!$reservaModel) {
            throw new NotFoundHttpException('The requested reservation does not exist.');
        }

        // Create a new Fatura
        $fatura = new Fatura([
            'totalf' => $reservaModel->valor,
            'totalsi' => $reservaModel->valor - $iva,
            'iva' => $iva,
            'reserva_id' => $reservaId,
            'empresa_id' => 1,
            'data' => date('Y-m-d'),
        ]);

        $fatura->save();

        // Save the Fatura
        if ($fatura->save()) {
            // Fetch LinhasReserva for the given reservaId
            $linhasReserva = LinhasReserva::findAll(['reserva_id' => $reservaId]);

            foreach ($linhasReserva as $linhaReserva) {
                $linhaFatura = new LinhasFatura([
                    'quantidade' => 1,
                    'precounitario' => $linhaReserva->subtotal,
                    'subtotal' => $reservaModel->valor,
                    'iva' => $iva,
                    'fatura_id' => $fatura->id,
                    'linhasreservas_id' => $linhaReserva->id,
                ]);

                $linhaFatura->save(); // Save each LinhasFatura
            }

            // Redirect or do something else
            return $this->redirect(['faturas/index']);
        } else {
            // Handle the case where the Fatura could not be saved
            Yii::$app->session->setFlash('error', 'Error creating the invoice.');
            return $this->redirect(['faturas/index']);
        }
    }


    public function actionEdit($id)
    {
        $fatura = Fatura::findOne($id);

        if ($fatura === null) {
            throw new NotFoundHttpException('A fatura não foi encontrada.');
        }

        if ($fatura->load(Yii::$app->request->post()) && $fatura->save()) {
            Yii::$app->session->setFlash('success', 'Fatura atualizada com sucesso.');
            return $this->redirect(['index']);
        }

        return $this->render('edit', ['fatura' => $fatura,
         'selectReservas' => $fatura->selectReservas()]);
    }


    public function actionShow($id)
    {
        $fatura = new Fatura();
        $reserva = Reserva::findOne($id);
        $empresa = Empresa::findOne(1); // Substitua 1 pelo ID da empresa que você deseja mostrar

        if ($reserva && $empresa) {
            $fatura->reserva_id = $id;
        } else {
            Yii::$app->session->setFlash('error', 'Erro ao encontrar a reserva ou empresa.');
        }

        return $this->render('show', [
            'fatura' => $fatura,
            'reserva' => $reserva,
            'empresa' => $empresa, // Certifique-se de passar a variável $empresa para a visão
        ]);
    }


    public function actionDelete($id)
    {
        $fatura = Fatura::findOne($id);

        // Lógica para excluir uma fatura

        $fatura->delete();
        Yii::$app->session->setFlash('success', 'Fatura apagada com sucesso.');

        return $this->redirect(['index']);
    }

    public function actionSearch(){
        $reservaModel = new ReservaSearch();
        $dataProvider = $reservaModel->search(Yii::$app->request->queryParams);
    }
}
