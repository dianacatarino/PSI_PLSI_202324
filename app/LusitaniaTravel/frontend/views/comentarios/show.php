<?php

use yii\helpers\Html;

$this->title = 'Detalhes do Comentário';

?>

<div class="detalhes-comentario">
    <div class="mb-3">
        <?= Html::a('<i class="fas fa-arrow-left"></i> Voltar', ['comentarios/index'], ['class' => 'btn btn-secondary']) ?>
    </div>
    <h3><?= Html::encode($this->title) ?></h3>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><?= Html::encode('Comentário ' . $comentario->id) ?></h5>

            <table class="table detalhes-comentario-table">
                <tbody>
                <tr>
                    <th scope="row">Alojamento</th>
                    <td><?= Html::encode($comentario->fornecedor->nome_alojamento) ?></td>
                </tr>
                <tr>
                    <th scope="row">Título</th>
                    <td><?= Html::encode($comentario->titulo) ?></td>
                </tr>
                <tr>
                    <th scope="row">Descrição</th>
                    <td><?= Html::encode($comentario->descricao) ?></td>
                </tr>
                <tr>
                    <th scope="row">Data Comentário</th>
                    <td><?= Html::encode($comentario->data_comentario) ?></td>
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
                    <tr>
                        <th scope="row">Data Avaliação</th>
                        <td><?= Html::encode($avaliacao->data_avaliacao) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

