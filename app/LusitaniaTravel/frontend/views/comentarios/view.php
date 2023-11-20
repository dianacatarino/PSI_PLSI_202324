<?php

use yii\helpers\Html;

$this->title = 'Detalhes do Comentário';

?>

<div class="detalhes-comentario">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Comentário #1</h5>

            <table class="table detalhes-comentario-table">
                <tbody>
                <tr>
                    <th scope="row">Título</th>
                    <td>Lorem impsum</td>
                </tr>
                <tr>
                    <th scope="row">Descrição</th>
                    <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</td>
                </tr>
                <tr>
                    <th scope="row">Data Comentário</th>
                    <td>2023-01-15</td>
                </tr>
                </tbody>
            </table>

            <!-- Adicione mais detalhes ou botões conforme necessário -->

            <?= Html::a('Voltar', ['index'], ['class' => 'btn btn-secondary']) ?>
        </div>
    </div>
</div>

