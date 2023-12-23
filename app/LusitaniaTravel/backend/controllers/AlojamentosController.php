<?php

namespace backend\controllers;

use common\models\Fornecedor;
use common\models\Imagem;
use Yii;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class AlojamentosController extends \yii\web\Controller
{
    /*public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'login', 'error', 'contact', 'register', 'perfil', 'definicoes', 'forgot-password','create','edit','show','delete','enviarimagens'],
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
    }*/

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

            // Check if Fornecedor model has a valid primary key
            if ($model->primaryKey) {
                // Alteração aqui: armazenar o caminho relativo completo
                $caminhoRelativo = '/LusitaniaTravel/common/public/img/' . $filename;

                $imagemModel = new Imagem(['filename' => $caminhoRelativo]);
                $model->link('imagens', $imagemModel);
            } else {
                Yii::warning("Fornecedor model does not have a valid primary key.");
                // Handle the case where Fornecedor model does not have a valid primary key
            }
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

            if ($fornecedor->save()) {
                $this->enviarImagens($fornecedor);
                // O modelo foi salvo com sucesso
                return $this->redirect(['alojamentos/index']);
            }
        }

        return $this->render('create', [
            'fornecedor' => $fornecedor,
            'selectFornecedores' => $fornecedor->selectFornecedores()
        ]);
    }

    public function actionEdit($id)
    {
        $fornecedor = Fornecedor::findOne($id);

        if (!$fornecedor) {
            throw new NotFoundHttpException('O alojamento não foi encontrado.');
        }

        $responsaveis = Fornecedor::find()->select(['responsavel'])->distinct()->column();
        $tipos = Fornecedor::find()->select(['tipo'])->distinct()->column();

        if ($fornecedor->load(Yii::$app->request->post())) {
            $this->enviarImagens($fornecedor);

            if (!empty($fornecedor->acomodacoes_alojamento)) {
                $fornecedor->acomodacoes_alojamento = implode(';', $fornecedor->acomodacoes_alojamento);
            }

            if (!empty($fornecedor->tipoquartos)) {
                $fornecedor->tipoquartos = implode(';', $fornecedor->tipoquartos);
            }

            if ($fornecedor->save()) {
                return $this->redirect(['alojamentos/index']);
            }
        }

        return $this->render('edit', [
            'fornecedor' => $fornecedor,
            'selectFornecedores' => $fornecedor->selectFornecedores(),
            'responsaveis' => $responsaveis,
            'tipos' => $tipos,
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

