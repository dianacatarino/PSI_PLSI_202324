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
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class FaturasController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'login', 'error', 'contact', 'register', 'perfil', 'definicoes', 'forgot-password', 'create', 'edit', 'show', 'delete', 'get-reserva-info', 'download','gerar-fatura-pdf'],
                        'roles' => ['?', '@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => false,
                        'actions' => ['login'],
                        'roles' => ['cliente'],
                        'denyCallback' => function ($rule, $action) {
                            Yii::$app->session->setFlash('error', 'Clientes não têm permissão para acessar o backend.');
                            Yii::$app->user->logout();
                            return $this->goHome();
                        },
                    ],
                ],
            ],
        ];
    }

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

        $fileContent = $this->gerarFaturaPdf($fatura);

        // Configurar o cabeçalho da resposta para o download
        Yii::$app->response->format = Response::FORMAT_RAW;
        Yii::$app->response->headers->add('Content-Type', 'application/pdf');
        Yii::$app->response->headers->add('Content-Disposition', 'attachment; filename="fatura_' . $fatura->id . '.pdf"');

        // Enviar o conteúdo do arquivo para o navegador
        Yii::$app->response->content = $fileContent;

        return Yii::$app->response;
    }

    private function gerarFaturaPdf($fatura)
    {
        // Configuração mPDF
        $mpdf = new Mpdf();

        // Conteúdo do PDF
        $pdfContent = '<div>';
        $pdfContent .= '<div style="float: left; margin-bottom: 20px;">';
        $pdfContent .= '<img src="/LusitaniaTravel/frontend/public/img/logo_icon.png" alt="Imagem da Empresa" style="width: 100px; height: auto; margin-right: 20px;">';
        $pdfContent .= '<h1>Fatura ' . $fatura->id . '</h1>';
        $pdfContent .= '</div>';
        $pdfContent .= '<div style="float: right; margin-top: 10px;">' . $fatura->data . '</div>';
        $pdfContent .= '<div style="clear: both;"></div>'; // Limpar flutuações

        // Adiciona detalhes da empresa (lado esquerdo)
        $empresa = Empresa::findOne($fatura->empresa_id);
        if ($empresa !== null) {
            $pdfContent .= '<div style="float: left; width: 50%; text-align: left;">';
            $enderecoEmpresa = $empresa->morada . ', ' . $empresa->localidade;
            $pdfContent .= '<p>' . $empresa->sede . '</p>';
            $pdfContent .= '<p>' . $empresa->morada . '</p>';
            $pdfContent .= '<p>' . $enderecoEmpresa . '</p>';
            $pdfContent .= '<p>' . $empresa->email . '</p>';
            $pdfContent .= '<p>' . $empresa->nif . '</p>';
            $pdfContent .= '</div>';
        }

        // Adiciona detalhes do cliente (lado direito)
        $reserva = Reserva::findOne($fatura->reserva_id);
        $pdfContent .= '<div style="float: right; width: 50%; text-align: right;">';
        $enderecoCliente = $reserva->cliente->profile->street . ', ' . $reserva->cliente->profile->locale;
        $pdfContent .= '<p>' . $reserva->cliente->profile->name . '</p>';
        $pdfContent .= '<p>' . $enderecoCliente . '</p>';
        $pdfContent .= '<p>' . $reserva->cliente->profile->postalCode . '</p>';
        $pdfContent .= '<p>' . $reserva->cliente->email . '</p>';
        $pdfContent .= '<p>' . $reserva->cliente->profile->mobile . '</p>';
        $pdfContent .= '</div>';

        $pdfContent .= '<div style="clear: both;"></div>'; // Limpar flutuações
        $pdfContent .= '</div>'; // Fechar a div principal

        // Adiciona detalhes das linhas de fatura
        $pdfContent .= '<div style="margin-top: 20px;">';
        $pdfContent .= '<table border="1" style="width: 100%;">';
        $pdfContent .= '<tr>';
        $pdfContent .= '<th>Quantidade</th>';
        $pdfContent .= '<th>Preço Unitário</th>';
        $pdfContent .= '<th>Subtotal</th>';
        $pdfContent .= '</tr>';

        // Obtenha as linhas de fatura associadas a esta fatura
        $linhasFatura = LinhasFatura::findAll(['fatura_id' => $fatura->id]);
        foreach ($linhasFatura as $linha) {
            $pdfContent .= '<tr>';
            $pdfContent .= '<td>' . $linha->quantidade . '</td>';
            $pdfContent .= '<td>' . $linha->precounitario . '€</td>';
            $pdfContent .= '<td>' . $linha->subtotal . '€</td>';
            $pdfContent .= '</tr>';
        }

        $pdfContent .= '</table>';
        $pdfContent .= '</div>';

        // Adiciona detalhes da fatura
        $pdfContent .= '<div style="clear: both; margin-top: 20px;">';
        $pdfContent .= '<p><strong>Total: </strong>' . $fatura->totalf . '€</p>';
        $pdfContent .= '<p><strong>Total sem IVA: </strong>' . $fatura->totalsi . '€</p>';
        $pdfContent .= '<p><strong>IVA: </strong>' . $fatura->iva * 100 . '%</p>';
        $pdfContent .= '</div>';

        // Adiciona o nome do funcionário
        $pdfContent .= '<div style="margin-top: 20px;">';
        $pdfContent .= '<p><strong>Funcionário: </strong>' . $reserva->funcionario->profile->name . '</p>';
        // Adicione outros campos do funcionário conforme necessário
        $pdfContent .= '</div>';

        $pdfContent .= '<div style="clear: both;"></div>'; // Limpar flutuações
        $pdfContent .= '</div>'; // Fechar a div principal

        // Adicionar conteúdo ao mPDF
        $mpdf->WriteHTML($pdfContent);

        // Saída para uma variável
        $fileContent = $mpdf->Output('', 'S');

        return $fileContent;
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