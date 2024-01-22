<?php

namespace frontend\controllers;

use backend\models\Empresa;
use common\models\Fatura;
use common\models\Linhasfatura;
use common\models\Prestacao;
use common\models\Reserva;
use Mpdf\Mpdf;
use Yii;
use yii\db\Expression;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class FaturasController extends \yii\web\Controller
{
    public function actionIndex()
    {
        // Obtenha o ID do usuário logado
        $userId = Yii::$app->user->id;

        // Modifique a consulta para incluir faturas associadas às reservas do usuário logado
        $faturas = Fatura::find()
            ->innerJoin('reservas', 'reservas.id = faturas.reserva_id')
            ->andWhere(['reservas.cliente_id' => $userId])  // Filtrar pelo cliente_id do usuário logado
            ->all();

        return $this->render('index', ['faturas' => $faturas,
            'userId' => $userId,]);
    }

    public function actionShow($id)
    {
        $fatura = Fatura::findOne($id);

        if ($fatura === null) {
            throw new NotFoundHttpException('Fatura não encontrada.');
        }

        return $this->render('show', ['fatura' => $fatura]);
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
        $pdfContent .= '<div style="clear: both;"></div>'; // Limpar flutuações
        $pdfContent .= '<div style="float: right; margin-top: 10px;">' . $fatura->data . '</div>';
        $pdfContent .= '</div>';

        // Adiciona detalhes da empresa (lado esquerdo)
        $empresa = Empresa::findOne($fatura->empresa_id);
        if ($empresa !== null) {
            $pdfContent .= '<div style="float: left; width: 50%; text-align: left;">';
            $enderecoEmpresa = $empresa->morada . ', ' . $empresa->localidade;
            $pdfContent .= '<p>' . $empresa->sede . '</p>';
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
        // Adicione outros campos da tabela Faturas conforme necessário
        $pdfContent .= '</div>';

        // Adiciona o nome do funcionário
        $pdfContent .= '<div style="margin-top: 20px;">';
        $pdfContent .= '<p><strong>Funcionário: </strong>' . $reserva->funcionario->profile->name . '</p>';
        $pdfContent .= '</div>';

        $pdfContent .= '<div style="clear: both;"></div>'; // Limpar flutuações
        $pdfContent .= '</div>'; // Fechar a div principal

        // Adicionar conteúdo ao mPDF
        $mpdf->WriteHTML($pdfContent);

        // Saída para uma variável
        $fileContent = $mpdf->Output('', 'S');

        return $fileContent;
    }
}
