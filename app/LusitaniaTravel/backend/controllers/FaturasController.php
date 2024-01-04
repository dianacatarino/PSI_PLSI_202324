<?php

namespace backend\controllers;

use common\models\Fatura;
use common\models\Linhasfatura;
use backend\models\Empresa;
use backend\models\ReservaSearch;
use common\models\Linhasreserva;
use common\models\Reserva;
use Mpdf\Mpdf;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class FaturasController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $faturas = Fatura::find()->with('linhasfaturas')->all();

        return $this->render('index', ['faturas' => $faturas]);
    }

    public function actionCreate()
    {
        $fatura = new Fatura();
        $reservaModel = new ReservaSearch();

        // Se o formulário for enviado
        if ($reservaModel->load(Yii::$app->request->get()) && $reservaModel->validate()) {
            $reservaId = $reservaModel->id;

            // Encontrar o modelo de Reserva
            $reserva = Reserva::findOne($reservaId);
            $iva = 0.23;

            if (!$reserva) {
                throw new NotFoundHttpException('A reserva solicitada não existe.');
            }

            // Criar uma nova Fatura
            $fatura = new Fatura([
                'totalf' => $reserva->valor,
                'totalsi' => $reserva->valor - $iva,
                'iva' => $iva,
                'reserva_id' => $reservaId,
                'empresa_id' => 1,
                'data' => date('Y-m-d'),
            ]);

            // Salvar a Fatura
            if ($fatura->save()) {
                // Fetch LinhasReserva para o reservaId fornecido
                $linhasReserva = LinhasReserva::findAll(['reservas_id' => $reservaId]);

                foreach ($linhasReserva as $linhaReserva) {
                    $linhaFatura = new LinhasFatura([
                        'quantidade' => 1,
                        'precounitario' => $linhaReserva->subtotal,
                        'subtotal' => $reserva->valor,
                        'iva' => $iva,
                        'fatura_id' => $fatura->id,
                        'linhasreservas_id' => $linhaReserva->id,
                    ]);

                    $linhaFatura->save(); // Salvar cada LinhasFatura
                }

                // Redirecionar ou fazer algo mais
                Yii::$app->session->setFlash('success', 'Fatura criada com sucesso.');
                return $this->redirect(['faturas/index']);
            } else {
                // Lidar com o caso em que a Fatura não pôde ser salva
                Yii::$app->session->setFlash('error', 'Erro ao criar a fatura.');
            }
        }

        // Renderizar a visão com a lista de reservas
        return $this->render('create', [
            'fatura' => $fatura,
            'reservaModel' => $reservaModel,
            'selectReservas' => $fatura->selectReservas(), // Use o método selectReservas()
        ]);
    }

    public function actionGetReservaInfo($id)
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;

        $reserva = Reserva::findOne($id);

        if ($reserva) {
            return [
                'cliente_id' => $reserva->cliente_id,
                'fornecedor_id' => $reserva->fornecedor_id,
                'fornecedor_nome_alojamento' => $reserva->fornecedor->nome_alojamento,
                'cliente_profile_name' => $reserva->cliente->profile->name,
            ];
        } else {
            return ['error' => 'Reserva not found'];
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
        $fatura = Fatura::findOne($id);
        $reserva = Reserva::findOne(['id' => $fatura->reserva_id]);
        $empresa = Empresa::findOne(1); // Substitua 1 pelo ID da empresa que você deseja mostrar

        if ($reserva && $empresa) {
            // Buscar as linhas de fatura associadas à fatura com o ID fornecido
            $linhasfaturas = Linhasfatura::find()->where(['fatura_id' => $id])->all();
        } else {
            Yii::$app->session->setFlash('error', 'Erro ao encontrar a reserva ou empresa.');
            $linhasfaturas = null; // Defina $linhasfaturas como null se houver um erro
        }

        return $this->render('show', [
            'fatura' => $fatura,
            'reserva' => $reserva,
            'empresa' => $empresa,
            'linhasfaturas' => $linhasfaturas, // Passar as linhas de fatura para a visão
        ]);
    }

    public function actionDownload($id)
    {
        $fatura = Fatura::findOne($id);

        if ($fatura === null) {
            throw new NotFoundHttpException('Fatura não encontrada.');
        }

        // Configurar o cabeçalho da resposta para o download
        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        Yii::$app->response->headers->add('Content-Type', 'application/pdf');
        Yii::$app->response->headers->add('Content-Disposition', 'attachment; filename="fatura_' . $fatura->id . '.pdf"');

        // Inicializar o mPDF
        $mpdf = new Mpdf();

        // Adicionar o HTML ao mPDF
        $htmlContent = $this->renderPartial('show', [
            'fatura' => $fatura,
            'reserva' => Reserva::findOne(['id' => $fatura->reserva_id]),
            'empresa' => Empresa::findOne(1),
            'linhasfaturas' => Linhasfatura::find()->where(['fatura_id' => $id])->all(),
        ]);

        $mpdf->WriteHTML($htmlContent);

        // Saída do PDF
        Yii::$app->response->content = $mpdf->Output('', 'S');

        return Yii::$app->response;
    }


    public function actionDelete($id)
    {
        $fatura = Fatura::findOne($id);

        // Lógica para excluir uma fatura

        $fatura->delete();
        Yii::$app->session->setFlash('success', 'Fatura apagada com sucesso.');

        return $this->redirect(['index']);
    }
}