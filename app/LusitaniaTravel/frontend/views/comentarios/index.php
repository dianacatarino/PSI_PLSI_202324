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
                        <th scope="row">Data</th>
                        <td><?= Html::encode($comentario->data_comentario) ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Título</th>
                        <td><?= Html::encode($comentario->titulo) ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Descrição</th>
                        <td><?= Html::encode($comentario->descricao) ?></td>
                    </tr>
                    </tbody>
                </table>

                <?php foreach ($avaliacoes as $avaliacao): ?>
                        <p>
                            <strong>Avaliação:</strong>
                            <?= Html::encode($avaliacao->classificacao) ?>
                        </p>
                <?php endforeach; ?>

                <?= Html::a('Detalhes', ['comentarios/show'], ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>

