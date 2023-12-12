<?php

use yii\helpers\Html;

$this->title = 'Detalhes do Favorito';

?>

<div class="detalhes-favorito">
    <div class="mb-3">
        <?= Html::a('<i class="fas fa-arrow-left"></i> Voltar', ['favoritos/index'], ['class' => 'btn btn-secondary']) ?>
    </div>
    <h3><?= Html::encode($this->title) ?></h3>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><?= Html::encode($fornecedor->nome_alojamento) ?></h5>

            <table class="table detalhes-favorito-table">
                <tbody>
                <tr>
                    <th scope="row">Nome do Alojamento</th>
                    <td><?= Html::encode($fornecedor->nome_alojamento) ?></td>
                </tr>
                <tr>
                    <th scope="row">Tipo</th>
                    <td><?= Html::encode($fornecedor->tipo) ?></td>
                </tr>
                <tr>
                    <th scope="row">Localização</th>
                    <td><?= Html::encode($fornecedor->localizacao_alojamento) ?></td>
                </tr>
                <tr>
                    <th scope="row">Acomodações</th>
                    <td><?= Html::encode($fornecedor->acomodacoes_alojamento) ?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

