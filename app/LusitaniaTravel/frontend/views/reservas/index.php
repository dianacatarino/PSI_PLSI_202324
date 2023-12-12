<?php

use yii\helpers\Html;

$this->title = 'As Minhas Reservas';
?>

<div class="reserva">
    <h3>Reservas</h3>

    <?php if (empty($reservas)): ?>
        <p>Você não possui nenhuma reserva no momento.</p>
    <?php else: ?>
        <?php foreach ($reservas as $reserva): ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Reserva <?= $reserva->id ?></h5>
                    <table class="table reserva-table">
                        <tbody>
                        <tr>
                            <th scope="row">Check-in</th>
                            <td><?= $reserva->checkin ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Check-out</th>
                            <td><?= $reserva->checkout ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Valor</th>
                            <td><?= $reserva->valor ?>€</td>
                        </tr>
                        <tr>
                            <th scope="row">Estado</th>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>

                    <?= Html::a('Detalhes', ['reservas/show', 'id' => $reserva->id], ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
