<?php

namespace frontend\controllers;

use common\models\Avaliacao;
use common\models\Comentario;
use common\models\Reserva;
use Yii;
use yii\web\NotFoundHttpException;

class ComentariosController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $userId = Yii::$app->user->id;

        // Buscar todos os comentários do usuário
        $comentarios = Comentario::find()
            ->where(['cliente_id' => $userId])
            ->all();

        // Buscar todas as avaliações do usuário
        $avaliacoes = Avaliacao::find()
            ->where(['cliente_id' => $userId])
            ->all();

        // Organizar as avaliações por fornecedor para facilitar o processamento
        $avaliacoesPorFornecedor = [];
        foreach ($avaliacoes as $avaliacao) {
            $avaliacoesPorFornecedor[$avaliacao->fornecedor_id][] = $avaliacao;
        }

        // Passar os dados organizados para a visualização
        return $this->render('index', [
            'comentarios' => $comentarios,
            'avaliacoes' => $avaliacoesPorFornecedor,
        ]);
    }

    public function actionCreate($fornecedor_id)
    {
        if (Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('error', 'Você precisa estar logado para adicionar um comentário e avaliação.');
            return $this->redirect(['site/login']); // Altere para a ação correta de login se necessário
        }

        // Verificar se o user fez uma reserva com o fornecedor associado
        $reservaExistente = Reserva::find()
            ->where(['cliente_id' => Yii::$app->user->id])
            ->andWhere(['fornecedor_id' => $fornecedor_id])
            ->exists();

        if (!$reservaExistente) {
            Yii::$app->session->setFlash('error', 'Você precisa de fazer uma reserva neste alojamento para poder adicionar um comentário e avaliação.');
            return $this->redirect(Yii::$app->request->referrer ?: ['alojamentos/show', 'id' => $fornecedor_id]);
        }

        $comentario = new Comentario();
        $avaliacao = new Avaliacao();

        if ($comentario->load(Yii::$app->request->post()) && $avaliacao->load(Yii::$app->request->post())) {
            $comentario->cliente_id = Yii::$app->user->id;
            $comentario->fornecedor_id = $fornecedor_id;
            $comentario->data_comentario = date('Y-m-d');

            $avaliacao->cliente_id = Yii::$app->user->id;
            $avaliacao->fornecedor_id = $fornecedor_id;
            $avaliacao->data_avaliacao = date('Y-m-d');

            if ($comentario->validate() && $avaliacao->validate()) {
                // Salvar o Comentário
                $comentario->save();

                // Salvar a Avaliação
                $avaliacao->save();

                Yii::$app->session->setFlash('success', 'Comentário e Avaliação criados com sucesso.');
                return $this->redirect(Yii::$app->request->referrer ?: ['alojamentos/show', 'id' => $fornecedor_id]);
            } else {
                Yii::$app->session->setFlash('error', 'Erro ao validar o Comentário e Avaliação.');
            }
        }

        return $this->render('create', [
            'comentario' => $comentario,
            'avaliacao' => $avaliacao,
        ]);
    }

    public function actionEdit($fornecedor_id)
    {
        $comentario = Comentario::findOne(['fornecedor_id' => $fornecedor_id, 'cliente_id' => Yii::$app->user->id]);

        // Busca todas as avaliações relacionadas ao fornecedor
        $avaliacoes = Avaliacao::find()->where(['fornecedor_id' => $fornecedor_id, 'cliente_id' => Yii::$app->user->id])->all();

        // Verifica se o comentário pertence ao usuário logado
        if (!$comentario) {
            Yii::$app->session->setFlash('error', 'Comentário não encontrado ou você não tem permissão para editar.');
            return $this->redirect(['index']);
        }

        // Verifica se o comentário e as avaliações podem ser carregados
        if ($comentario->load(Yii::$app->request->post())) {
            // Atualiza a data_comentario
            $comentario->data_comentario = date('Y-m-d');

            // Salva o comentário
            if ($comentario->save()) {
                foreach ($avaliacoes as $index => $avaliacao) {
                    // Carrega os dados da avaliação do formulário e salva
                    if ($avaliacao->load(Yii::$app->request->post()) && $avaliacao->save()) {
                        // Salvar alterações na avaliação
                    } else {
                        Yii::$app->session->setFlash('error', 'Erro ao salvar as alterações na avaliação.');
                        return $this->redirect(['index']);
                    }
                }

                Yii::$app->session->setFlash('success', 'Comentário e Avaliações atualizadas com sucesso.');
                return $this->redirect(['index']);
            } else {
                Yii::$app->session->setFlash('error', 'Erro ao salvar as alterações no comentário.');
            }
        }

        return $this->render('edit', [
            'comentario' => $comentario,
            'avaliacoes' => $avaliacoes,
        ]);
    }

    public function actionShow($id)
    {
        // Lógica para exibir detalhes de um comentário específico
        $comentario = Comentario::findOne($id);

        if ($comentario === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        // Obter avaliações associadas com base em fornecedor_id e user_id
        $avaliacoes = Avaliacao::find()
            ->where(['fornecedor_id' => $comentario->fornecedor_id, 'cliente_id' => $comentario->cliente_id])
            ->all();

        return $this->render('show', ['comentario' => $comentario, 'avaliacoes' => $avaliacoes]);
    }

    public function actionDelete($id)
    {
        // Lógica para excluir um comentário específica
        $comentario = Comentario::findOne($id);

        if ($comentario->delete()) {
            Yii::$app->session->setFlash('success', 'Comentário excluída com sucesso.');
        } else {
            Yii::$app->session->setFlash('error', 'Erro ao excluir o comentário.');
        }

        return $this->redirect(['index']);
    }


}
