<?php

namespace backend\controllers;

use backend\models\Fornecedor;
use backend\models\Imagem;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class AlojamentosController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $fornecedores = Fornecedor::find()->with('imagens')->all();

        return $this->render('index', ['fornecedores' => $fornecedores]);
    }

    private function enviarImagens($model)
    {
        // Diretório onde as imagens serão salvas
        $uploadPath = Yii::getAlias('@common') . '/public/img/';
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true);  // Cria o diretório se não existir
        }

        $imagens = UploadedFile::getInstances($model, 'imagens');

        foreach ($imagens as $imagem) {
            $filename = $imagem->baseName . '.' . $imagem->extension;
            $imagem->saveAs($uploadPath . $filename);

            // Alteração aqui: armazenar o caminho relativo completo
            $caminhoRelativo = '/LusitaniaTravel/common/public/img/' . $filename;

            $imagemModel = new Imagem(['filename' => $caminhoRelativo]);
            $model->link('imagens', $imagemModel);
        }
    }


    public function actionCreate()
    {
        $fornecedor = new Fornecedor();

        if (Yii::$app->request->isPost) {
            $fornecedor->load(Yii::$app->request->post());

            // Processar as opções de acomodações selecionadas
            if (!empty($fornecedor->acomodacoes_alojamento)) {
                $fornecedor->acomodacoes_alojamento = implode(';', $fornecedor->acomodacoes_alojamento);
            }

            $this->enviarImagens($fornecedor);


            if ($fornecedor->save()) {
                // O modelo foi salvo com sucesso
                return $this->redirect(['view', 'id' => $fornecedor->id]);
            }
        }

        return $this->render('create', [
            'fornecedor' => $fornecedor,
        ]);
    }

    public function actionEdit($id)
    {
        $fornecedor = Fornecedor::findOne($id);

        if (!$fornecedor) {
            throw new NotFoundHttpException('O alojamento não foi encontrado.');
        }

        if ($fornecedor->load(Yii::$app->request->post())) {
            // Remova a linha abaixo relacionada ao método enviarImagens se você não precisar dela aqui
            $this->enviarImagens($fornecedor);


            $fornecedor->acomodacoes_alojamento = Yii::$app->request->post('Fornecedor')['acomodacoes_alojamento'];

            if ($fornecedor->save()) {
                return $this->redirect(['alojamentos/index']);
            }
        }

        return $this->render('edit', [
            'fornecedor' => $fornecedor,
        ]);
    }


    public function actionShow($id)
    {
        $fornecedor = Fornecedor::find()
            ->with('imagens')
            ->where(['id' => $id])
            ->one();

        if (!$fornecedor) {
            throw new NotFoundHttpException('O alojamento não foi encontrado.');
        }

        return $this->render('show', ['fornecedor' => $fornecedor]);
    }


    public function actionDelete($id)
    {
        $fornecedor = Fornecedor::findOne($id);

        if (!$fornecedor) {
            throw new NotFoundHttpException('O alojamento não foi encontrado.');
        }

        // Excluir imagens associadas ao fornecedor
        foreach ($fornecedor->imagens as $imagem) {
            $imagem->delete();
        }

        // Agora, exclua o fornecedor
        if ($fornecedor->delete()) {
            return $this->redirect(['alojamentos/index']);
        } else {
            Yii::$app->session->setFlash('error', 'Erro ao excluir o alojamento.');
            return $this->redirect(['alojamentos/index']);
        }

    }

}

