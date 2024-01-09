<?php

use yii\helpers\Html;

$this->title = 'Detalhes da Reserva';

?>

<div class="detalhes-reserva">
    <div class="mb-3">
        <?= Html::a('<i class="fas fa-arrow-left"></i> Voltar', ['reservas/index'], ['class' => 'btn btn-secondary']) ?>
    </div>
    <h3><?= Html::encode($this->title) ?></h3>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Reserva <?= Html::encode($reserva->id) ?></h5>

            <table class="table detalhes-reserva-table">
                <tbody>
                <tr>
                    <th scope="row">Tipo</th>
                    <td><?= Html::encode($reserva->tipo) ?></td>
                </tr>
                <tr>
                    <th scope="row">Check-in</th>
                    <td><?= Html::encode($reserva->checkin) ?></td>
                </tr>
                <tr>
                    <th scope="row">Check-out</th>
                    <td><?= Html::encode($reserva->checkout) ?></td>
                </tr>
                <tr>
                    <th scope="row">Número de Quartos</th>
                    <td><?= Html::encode($reserva->numeroquartos) ?></td>
                </tr>
                <tr>
                    <th scope="row">Número de Clientes</th>
                    <td><?= Html::encode($reserva->numeroclientes) ?></td>
                </tr>
                <tr>
                    <th scope="row">Valor</th>
                    <td><?= Html::encode($reserva->valor) ?> €</td>
                </tr>
                <tr>
                    <th scope="row">Alojamento</th>
                    <td><?= Html::encode($reserva->fornecedor->nome_alojamento) ?> </td>
                </tr>

                <?php foreach ($reserva->linhasreservas as $linhareserva): ?>
                    <tr>
                        <th scope="row">Tipo de Quarto</th>
                        <td><?= Html::encode($linhareserva->tipoquarto) ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Numero de Noites</th>
                        <td><?= Html::encode($linhareserva->numeronoites) ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Numero de Camas</th>
                        <td><?= Html::encode($linhareserva->numerocamas) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
