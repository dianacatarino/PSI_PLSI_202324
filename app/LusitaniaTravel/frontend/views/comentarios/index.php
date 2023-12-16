<?php

use yii\helpers\Html;

$this->title = 'Comentários';
?>

<div class="comentarios">
    <div class="mb-3">
        <?= Html::a('<i class="fas fa-arrow-left"></i> Voltar', ['user/index'], ['class' => 'btn btn-secondary']) ?>
    </div>
    <h1>Comentários</h1>

    <?php foreach ($comentarios as $comentario): ?>
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Comentário <?= Html::encode($comentario->id) ?></h5>
                <table class="table comentarios-table">
                    <tbody>
                    <tr>
                        <th scope="row">Alojamento</th>
                        <td><?= Html::encode($comentario->fornecedor->nome_alojamento) ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Comentário</th>
                        <td><?= Html::encode($comentario->descricao) ?></td>
                    </tr>
                    <?php foreach ($avaliacoes as $avaliacao): ?>
                        <tr>
                            <th scope="row"> Avaliação </th>
                            <td>
                                <?php
                                for ($i = 1; $i <= 5; $i++) {
                                    echo ($i <= $avaliacao->classificacao) ? '★' : '☆';
                                }
                                ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <?= Html::a('Detalhes', ['comentarios/show', 'id' => $comentario->id], ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>

