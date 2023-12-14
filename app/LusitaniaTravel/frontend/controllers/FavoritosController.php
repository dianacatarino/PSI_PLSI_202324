<?php

namespace frontend\controllers;

use common\models\Fornecedor;
use Yii;

class FavoritosController extends \yii\web\Controller
{
    public function actionIndex()
    {
        // Obtém o perfil do usuário
        $profile = Yii::$app->user->identity->profile;

        // Verifica se a coluna 'favorites' está vazia ou nula
        if (!empty($profile->favorites)) {
            // Decodifica a string JSON para obter um array de IDs
            $favoritoIds = json_decode($profile->favorites, true);

            // Busca os fornecedores com base nos IDs favoritos
            $favoritos = Fornecedor::find()->where(['id' => $favoritoIds])->all();
        } else {
            $favoritos = [];
        }

        return $this->render('index', ['favoritos' => $favoritos]);
    }

    public function actionAdicionar()
    {
        $fornecedorId = Yii::$app->request->get('fornecedorId');

        if ($fornecedorId !== null) {
            $profile = Yii::$app->user->identity->profile;

            $favoritos = $profile->favorites ? json_decode($profile->favorites, true) : [];

            if (!in_array($fornecedorId, $favoritos)) {
                $favoritos[] = $fornecedorId;
            }

            $profile->favorites = json_encode($favoritos);
            $profile->save();

            return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
        } else {
            Yii::$app->session->setFlash('error', 'Fornecedor ID not provided.');
            return $this->redirect(Yii::$app->homeUrl);
        }
    }

    public function actionRemover()
    {
        $fornecedorId = Yii::$app->request->get('fornecedorId');

        if ($fornecedorId !== null) {
            $profile = Yii::$app->user->identity->profile;

            $favoritos = $profile->favorites ? json_decode($profile->favorites, true) : [];

            if (in_array($fornecedorId, $favoritos)) {
                $favoritos = array_diff($favoritos, [$fornecedorId]);
            }

            $profile->favorites = json_encode($favoritos);
            $profile->save();

            return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
        } else {
            Yii::$app->session->setFlash('error', 'Fornecedor ID not provided.');
            return $this->redirect(Yii::$app->homeUrl);
        }
    }

    public function actionShow($id)
    {
        // Certifique-se de que o usuário está autenticado
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }

        // Obtenha o perfil do usuário
        $profile = Yii::$app->user->identity->profile;

        // Obtenha a lista de favoritos do perfil
        $favoritos = $profile->favorites ? json_decode($profile->favorites, true) : [];

        // Verifique se o ID fornecido está na lista de favoritos
        if (in_array($id, $favoritos)) {
            // Encontre o modelo Fornecedor com base no ID
            $fornecedor = Fornecedor::findOne($id);

            if ($fornecedor) {
                // Renderize a visualização de detalhes do favorito com o modelo Fornecedor
                return $this->render('show', [
                    'fornecedor' => $fornecedor,
                ]);
            } else {
                // Se o fornecedor não for encontrado, redirecione ou exiba uma mensagem de erro
                Yii::$app->session->setFlash('error', 'Fornecedor não encontrado.');
                return $this->redirect(['favoritos/index']);
            }
        } else {
            // Se o ID não estiver na lista de favoritos, redirecione ou exiba uma mensagem de erro
            Yii::$app->session->setFlash('error', 'Esse fornecedor não está na sua lista de favoritos.');
            return $this->redirect(['favoritos/index']);
        }
    }

}
