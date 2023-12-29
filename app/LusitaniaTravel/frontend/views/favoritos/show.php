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
                    <td>
                        <?php
                        $acomodacoes = explode(';', $fornecedor->acomodacoes_alojamento);
                        foreach ($acomodacoes as $acomodacao) {
                            echo Html::encode($acomodacao) . '<br>';
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Tipo Quartos</th>
                    <td>
                        <?php
                        $tipoQuartos = explode(';', $fornecedor->tipoquartos);
                        foreach ($tipoQuartos as $tipoQuarto) {
                            echo Html::encode($tipoQuarto) . '<br>';
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Preço por Noite</th>
                    <td><?= Html::encode($fornecedor->precopornoite) ?>€</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

