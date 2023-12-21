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
            <?php
            // Verifique se a reserva possui confirmações e se os valores são diferentes de zero
            $temConfirmacoes = !empty($reserva->confirmacoes);
            $valoresDiferentesZero = $temConfirmacoes && $reserva->valor != 0 && $reserva->confirmacoes[0]->estado != 0;

            if ($valoresDiferentesZero):
                ?>
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
                                <td><?= $temConfirmacoes ? $reserva->confirmacoes[0]->estado : 'Sem confirmações' ?></td>
                            </tr>
                            </tbody>
                        </table>

                        <?= Html::a('Detalhes', ['reservas/show', 'id' => $reserva->id], ['class' => 'btn btn-primary']) ?>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
